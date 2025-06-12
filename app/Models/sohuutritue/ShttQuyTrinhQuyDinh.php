<?php

namespace App\Models\sohuutritue;

use MongoDB\Laravel\Auth\User as AuthenticatableContract;

class ShttQuyTrinhQuyDinh extends AuthenticatableContract
{


    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'shtt_quy_trinh_quy_dinhs';   // Tên collection MongoDB
    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'content', 'image', 'file', 'created_at', 'updated_at' ];
}
