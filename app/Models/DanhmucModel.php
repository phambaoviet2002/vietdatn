<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LoaisanphamModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhmucModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'danh_muc';
    protected $fillable = [
        "ten_danh_muc",
        "ten_danh_muc_slug",
    ];

    public function LoaisanphamModel()
    {
        return $this->hasMany(LoaisanphamModel::class, 'ma_danh_muc', 'id');
    }


    protected static function booted()
    {
        static::deleting(function ($danhMuc) {
            $danhMuc->LoaisanphamModel()->withTrashed()->delete();
        });
        
        // static::restoring(function ($danhMuc) {
        //     $danhMuc->LoaisanphamModel()->restore();
        // });
    }

}