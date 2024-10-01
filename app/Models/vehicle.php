<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehicle extends Model
{
    use HasFactory;

    protected $fillable = ["vehicle_id", "license_plate", "vehicle_type", "capacity", "status", "vehicle_image", "carrier_id",];

    protected $primaryKey = 'vehicle_id'; // Khóa chính là 'vehicle_id'
    public $incrementing = false; // Nếu 'vehicle_id' không phải là auto-increment
    
}
