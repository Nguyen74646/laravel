<?php

namespace App\Models\vanbanquyphamphapluat;

use MongoDB\Laravel\Auth\User as AuthenticatableContract;

class VanBanThanhTra extends AuthenticatableContract
{


    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'van_ban_thanh_tras';   // Tên collection MongoDB
    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'content', 'image', 'file', 'created_at', 'updated_at' ];
}
