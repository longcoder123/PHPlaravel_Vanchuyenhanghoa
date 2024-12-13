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
     // Định nghĩa quan hệ một đến nhiều với bảng orders
     public function orders()
     {
         return $this->hasMany(Order::class, 'customer_id'); 
     }
    protected $primaryKey = 'user_id';
    public $incrementing = true;
}
