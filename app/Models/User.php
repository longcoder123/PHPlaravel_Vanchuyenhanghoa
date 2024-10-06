<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_id',
        'username',
        'password',
        'email',
        'created_at',
        'last_login',
        'status'
    ];

    protected $primaryKey = 'user_id';
    public $incrementing = true;
}
