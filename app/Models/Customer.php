<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'address', 'gender', 'dob', 'identity_number', 'additional_info', 'user_id'
    ];
     // Quan hệ ngược với User
     public function user()
     {
         return $this->belongsTo(User::class);
     }
    protected $primaryKey = 'customer_id';
    public $incrementing = true;
}
