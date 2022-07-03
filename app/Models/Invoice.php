<?php
namespace App\Models;

use App\Observers\InvoiceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoices";
    protected $fillable = ['customer_id', 'amount_of_events', 'total_price', 'users_data', 'start_date', 'end_date'];
    public $timestamps = true;

    public function getStartDateAttribute($value): string
    {
        return date('Y-m-d', strtotime($value));
    }

    public function getEndDateAttribute($value): string
    {
        return date('Y-m-d', strtotime($value));
    }

//Using observer to send notification after creating an invoice
    protected static function boot()
    {
        parent::boot();
        static::observe(new InvoiceObserver());
    }
}
