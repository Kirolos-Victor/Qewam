<?php
namespace App\Services;

use App\Models\Customer;
use App\Models\Invoice;

class InvoiceService
{
    public function get($request): array|string
    {
        $start = date($request->start);
        $end = date($request->end);
        $users = Customer::with([
            'users' => function ($query) use ($request, $start, $end) {
                $query->whereBetween('created_at', [$start, $end]);
            },
            'users.sessions'
        ])->where('id', $request->customer_id)
            ->get()
            ->pluck('users')
            ->collapse();
        $invoiceData = $this->getInvoiceData($users);
        return $this->getInvoiceId($invoiceData, $request);
    }

    public function getInvoiceData($users): array
    {
        $userData = [];
        foreach ($users as $user) {
            $sessions = $user->sessions;
            $totalEvents = 0;
            $userData[$user->id] = [
                'price' => config('constants.registration'),
                'type' => 'registration',
                'events' => $totalEvents += 1
            ];
            foreach ($sessions as $session) {
                if ($session->appointment != null) {
                    $userData[$user->id] = [
                        'price' => config('constants.appointment'),
                        'type' => 'appointment',
                        'events' => $totalEvents += 1
                    ];
                } elseif ($session->activated != null) {
                    $userData[$user->id] = [
                        'price' => config('constants.activated'),
                        'type' => 'activated',
                        'events' => $totalEvents += 1
                    ];
                }
            }
        }
        return $userData;
    }

    public function getInvoiceId($data, $request): array|string
    {
        $totalPrice = 0;
        $totalEvents = 0;
        try {
            $invoice = Invoice::where('customer_id', $request->customer_id)
                ->where('start_date', $request->start)
                ->where('end_date', $request->end)
                ->first();
            if ($invoice) {
                $totalPrice = 0;
            } else {
                foreach ($data as $user) {
                    $totalPrice += $user['price'];
                    $totalEvents += $user['events'];
                }
            }
            $newInvoice = Invoice::create([
                'customer_id' => $request->customer_id,
                'amount_of_events' => $totalEvents,
                'total_price' => $totalPrice,
                'users_data' => json_encode($data),
                'start_date' => $request->start,
                'end_date' => $request->end
            ]);
        } catch (\Exception$exception) {
            return $exception->getMessage();
        }
        return ['invoice_id' => $newInvoice->id];
    }
}
