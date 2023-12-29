<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoanModel extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tai_khoan';

    protected $fillable = [
        'ten_tai_khoan',
        'password',
        'email',
        'hinh_anh',
        'loai_tai_khoan',
        'so_dien_thoai',
        'dia_chi',
    ];
}
