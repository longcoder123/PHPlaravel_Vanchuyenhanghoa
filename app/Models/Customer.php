<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'phone',
        'address',
        'gender',
        'dob',
        'identity_number',
        'additional_info',
        'created_at'
    ];

    protected $primaryKey = 'customer_id';
    public $incrementing = true;
}
