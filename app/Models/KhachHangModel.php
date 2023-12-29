<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
class KhachHangModel extends Authenticatable
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'khach_hang';

    protected $fillable = [
        'ho_va_ten',
        'email',
        'password',
        'so_dien_thoai',
        'dia_chi',
        'ma_bam_email',
        'ngay_sinh',
        'gioi_tinh',
        'loai_tai_khoan',
        'ma_bam_quen_mat_khau',

    ];
}
