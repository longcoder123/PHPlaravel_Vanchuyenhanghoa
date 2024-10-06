<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'package_id',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'order_date',
        'delivery_date',
        'vehicle_id',
        'driver_id',
        'shipping_fee',
        'status'
    ];

    protected $primaryKey = 'order_id';
    public $incrementing = true;
}
