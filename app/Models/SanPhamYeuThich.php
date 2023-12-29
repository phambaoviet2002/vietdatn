<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamYeuThich extends Model
{
    use HasFactory;
    protected $table = 'san_pham_yeu_thich';
    protected $fillable = [
        'ma_san_pham',
        'ma_khach_hang',
    ];
}
