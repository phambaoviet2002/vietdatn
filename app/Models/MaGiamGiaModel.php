<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGiaModel extends Model
{
    use HasFactory;
    protected $table = 'ma_giam_gia';
   
    protected $fillable = [
        'ma_giam_gia',
        'tien_giam_gia',
        'so_luong',
    ];
}
