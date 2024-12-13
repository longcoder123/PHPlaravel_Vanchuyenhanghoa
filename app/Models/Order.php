<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
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
    public function packages()
    {
        return $this->hasMany(Package::class, 'package_id', 'package_id');
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    protected $primaryKey = 'order_id';
    public $incrementing = true;
}
