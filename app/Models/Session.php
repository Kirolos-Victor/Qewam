<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = "sessions";
    protected $fillable = ['activated', 'appointment', 'user_id'];
    public $timestamps = true;
}
