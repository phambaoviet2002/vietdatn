<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class HoadonModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'hoa_don';
    protected $primaryKey  = 'id';
    public $incrementing = false; // Đặt giá trị này thành false để ngăn chặn tự động tăng
    protected $fillable = [
        "id",
        "ma_khach_hang",
        "ho_va_ten",
        "so_dien_thoai",
        "dia_chi",
        "tong_tien_tat_ca",
        "trang_thai_don",
        "trang_thai_thanh_toan"
    ];
}