<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'users';   // Tên collection MongoDB
    use HasFactory;

    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'phone',
        'role',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
    ];
}
