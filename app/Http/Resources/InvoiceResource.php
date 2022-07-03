<?php
namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    public function toArray($request)
    {
        $users = json_decode($this->users_data, true);
        $data = [];
        $main = [];
        foreach ($users as $key => $user) {
            $userData = User::with('sessions')->where('id', $key)->first();
            $sessions = $userData->sessions;
            foreach ($sessions as $session) {
                if ($session->appointment != null) {
                    $main[] = ['Sessions with appointment: ' . date('Y-m-d', strtotime($session->appointment))];
                } else {
                    $main[] = ['Sessions with activated: ' . date('Y-m-d', strtotime($session->activated))];
                }
            }
            $data = [
                'Username: ' . $userData->name,
                'Registration: ' . $userData->created_at,
                $main,
                'Invoice total: ' . $this->total_price . " SAR"
            ];
        }
        return [
            'invoice Period' => $this->start_date . ' to ' . $this->end_date,
            'main' => $data
        ];
    }
}
