<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class driver extends Model
{
    use HasFactory;

    protected $fillable = ["driver_id", "name", "phone", "email", "liscense_number", "driver_image", "status", "vehicle_id"];
}
