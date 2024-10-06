<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id',
        'order_id',
        'payment_method',
        'amount',
        'status',
        'payment_date'
    ];

    protected $primaryKey = 'payment_id';
    public $incrementing = true;
}
