<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SanphamModel;
use Illuminate\Database\Eloquent\SoftDeletes;
class HinhanhModel extends Model
{
    use HasFactory;
    protected $table = 'hinh_anh';
    protected $fillable = [
        "hinh_anh",
        "ma_san_pham",
    ];

    public function SanphamModel()
    {
        return $this->hasMany(SanphamModel::class);
    }


}