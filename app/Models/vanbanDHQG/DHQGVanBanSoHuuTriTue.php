<?php

namespace App\Models\vanbanDHQG;

use MongoDB\Laravel\Auth\User as AuthenticatableContract;

class DHQGVanBanSoHuuTriTue extends AuthenticatableContract
{


    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'd_h_q_g_van_ban_so_huu_tri_tues';   // Tên collection MongoDB
    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'content', 'image', 'file', 'created_at', 'updated_at' ];
}
