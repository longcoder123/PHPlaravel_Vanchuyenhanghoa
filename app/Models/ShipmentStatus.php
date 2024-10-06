<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_id',
        'shipment_id',
        'vehicle_id',
        'driver_id',
        'status',
        'timestamp',
        'location'
    ];

    protected $primaryKey = 'status_id';
    public $incrementing = true;
}
