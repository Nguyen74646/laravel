<?php

namespace App\Models\thanhtra;

use Illuminate\Auth\Authenticatable;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VanBanBieuMauModel extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb'; // Kết nối MongoDB
    protected $collection = 'van_ban_bieu_mau_models';   // Tên collection MongoDB
    use HasFactory;

    // Cho phép tự động quản lý created_at và updated_at
    public $timestamps = true;
    protected $fillable = [
        'title', 'description', 'content', 'image', 'file', 'created_at', 'updated_at' ];

}
