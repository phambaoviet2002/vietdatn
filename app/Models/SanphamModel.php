<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HinhanhModel;
use App\Models\LoaisanphamModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class SanphamModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'san_pham';
    protected $primaryKey = 'id';

    protected $fillable = [
        "ten_san_pham",
        "ten_san_pham_slug",
        "gia_san_pham",
        "giam_gia_san_pham",
        "phan_tram_giam_gia",
        "ma_loai",
        "so_luong",
        "luot_xem",
        "dat_biet",
        "mo_ta",
        "trang_thai",
    ];

    public function HinhanhModel()
    {
        return $this->hasMany(HinhanhModel::class, 'ma_san_pham', 'id');
    }

    public function LoaisanphamModel()
    {
        return $this->belongsTo(LoaisanphamModel::class, 'ma_loai', 'id');
    }

}