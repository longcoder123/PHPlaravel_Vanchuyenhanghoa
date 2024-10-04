<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrier_id',
        'name',
        'phone',
        'email',
        'address'
    ];

    protected $primaryKey = 'carrier_id';
    public $incrementing = true;
}
