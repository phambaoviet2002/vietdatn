<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BinhluanModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'binh_luan';
    protected $primarykey = 'id';
    protected $fillable = [
        "noi_dung",
        "ma_san_pham",
        "ma_khach_hang",
        "rating",
        "hien_thi",
        "created_at",
        "updated_at",
    ];
}