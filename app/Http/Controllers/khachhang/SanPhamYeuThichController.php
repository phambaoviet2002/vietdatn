<?php

namespace App\Http\Controllers\khachhang;;

use App\Models\SanPhamYeuThich;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SanPhamYeuThichController extends Controller
{

    public function SanPhamYeuThich()
    {
        return view('Trang-Khach-Hang.page.SanPhamYeuThich');
    }

    public function QuanLySanPhamYeuThich($id)
    {
        $ma_khach_hang = Auth::guard('khach_hang')->user()->id;

        $sanPhamYeuThich = SanPhamYeuThich::where('ma_khach_hang', $ma_khach_hang)
            ->where('ma_san_pham', $id)
            ->first();
            
        if ($sanPhamYeuThich) {
            $sanPhamYeuThich->delete();
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Bỏ Yêu Thích Thành Công'
            ]);
        } else {
            SanPhamYeuThich::create([
                'ma_khach_hang' => $ma_khach_hang,
                'ma_san_pham' => $id,
            ]);
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Đã Yêu Thích Sản Phẩm'
            ]);
        }
    }

    public function HienThiSanPhamYeuThich()
    {
        $ma_khach_hang = Auth::guard('khach_hang')->user();
        if ($ma_khach_hang) {
            $ma_khach_hang_id = $ma_khach_hang->id;
            $san_pham_yeu_thich = SanPhamYeuThich::where('ma_khach_hang', $ma_khach_hang_id)
                ->join('san_pham', 'san_pham_yeu_thich.ma_san_pham', '=', 'san_pham.id')
                ->join('hinh_anh', function ($join) {
                    $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                        ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
                })
                ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
                ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
                ->get();
            // dd($san_pham_yeu_thich);
            return response()->json([
                'status' => true,
                'du_lieu' => $san_pham_yeu_thich
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ]);
        }
    }
}
