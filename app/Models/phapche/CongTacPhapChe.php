<?php

namespace App\Models\phapche;

use MongoDB\Laravel\Auth\User as AuthenticatableContract;

class CongTacPhapChe extends AuthenticatableContract
{


    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'cong_tac_phap_ches';   // Tên collection MongoDB
    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'content', 'image', 'file', 'created_at', 'updated_at' ];
}
