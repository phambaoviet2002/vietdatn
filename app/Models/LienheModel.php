<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
class LienheModel extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'lien_he';
    protected $primarykey = 'id';
    protected $fillable = [
        'ho_va_ten',
        'email',
        'tieu_de',
        'noi_dung',
        'so_dien_thoai',
        'xu_ly',
    ];
}