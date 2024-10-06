<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'customer_id',
        'description',
        'weight',
        'size',
        'value',
        'product_image',
        'status',
        'created_at'
    ];

    protected $primaryKey = 'package_id';
    public $incrementing = true;
}
