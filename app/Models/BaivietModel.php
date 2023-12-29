<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaivietModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'bai_viet';
    protected $primarykey = 'id';
    protected $fillable = [
        "ten_bai_viet",
        "ten_bai_viet_slug",
        "loai_tin",
        "mo_ta_ngan",
        "ma_nhan_vien",
        "noi_dung",
        "hinh_anh",
        "rating",
        "hien_thi",
        "created_at",
        "updated_at",
    ];
}