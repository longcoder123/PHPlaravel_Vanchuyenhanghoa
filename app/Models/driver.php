<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    protected $fillable = ["driver_id", "name", "phone", "email", "license_number", "driver_image", "status", "vehicle_id"];
    protected $primaryKey = 'driver_id'; // Đặt khóa chính là driver_id
    public $incrementing = false; // Nếu driver_id không phải là auto-increment

    public function vehicle()
    {
        
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'vehicle_id'); // Xác định khóa ngoại và khóa chính

    }
    
}
