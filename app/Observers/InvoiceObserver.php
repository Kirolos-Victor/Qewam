<?php
namespace App\Observers;

use App\Models\Customer;
use App\Notifications\InvoiceNotification;

class InvoiceObserver
{
    public function created()
    {
        $customer = Customer::where('id', Request('customer_id'))->first();
        $customer->notify(new InvoiceNotification($customer));
    }
}
