<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipment_id',
        'order_id',
        'vehicle_id',
        'driver_id',
        'carrier_name',
        'tracking_number',
        'departure_date',
        'arrival_date',
        'status'
    ];

    protected $primaryKey = 'shipment_id';
    public $incrementing = true;
}
