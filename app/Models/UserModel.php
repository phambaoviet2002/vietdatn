<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'user';
    protected $primarykey = 'id';
    protected $fillable = [
        "ten_khach_hang",
        "mat_khau",
        "ho_ten",
        "kich_hoat",
        "vai_tro",
        "email",
        "hinh_anh",
        "phan_quyen",
        "so_dien_thoai",
        "dia_chi",
        "created_at",
        "updated_at",
    ];
}