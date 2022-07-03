<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'customers';
    protected $fillable = ['name','email'];
    public $timestamps = true;

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'customer_id', 'id');
    }
}
