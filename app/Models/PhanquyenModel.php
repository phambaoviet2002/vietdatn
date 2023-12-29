<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PhanquyenModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'phan_quyen';
    protected $primarykey = 'id';
    protected $fillable = [
        "ten_phan_quyen",
        "role_phan_quyen",
        "created_at",
        "updated_at",
    ];
}