<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class HoadonchitietModel extends Model
{
    use HasFactory;
    protected $table = 'hoa_don_chi_tiet';
    protected $primarykey = 'id';
    protected $fillable = [
        "ma_hoa_don",
        "ma_san_pham",
        "tong_tien",
        "tong_so_luong",
    ];
}