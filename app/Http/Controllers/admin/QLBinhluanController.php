<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\binh_luan_bai_viets;
use App\Models\BinhluanModel;

use Illuminate\Support\Facades\Auth;

class QLBinhluanController extends Controller
{
    //
    public function index()
    {
        $data_binhluan_baiviet = binh_luan_bai_viets::orderBy('created_at', 'desc')
            ->join('khach_hang', 'binh_luan_bai_viet.ma_khach_hang', '=', 'khach_hang.id')
            ->join('bai_viet', 'binh_luan_bai_viet.ma_bai_viet', '=', 'bai_viet.id')
            ->select('binh_luan_bai_viet.*', 'khach_hang.ho_va_ten', 'bai_viet.ten_bai_viet', 'bai_viet.hinh_anh')
            ->get();
        $data_binhluan_sanpham = BinhluanModel::orderBy('created_at', 'desc')
            ->join('khach_hang', 'binh_luan.ma_khach_hang', '=', 'khach_hang.id')
            ->join('san_pham', 'binh_luan.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select('binh_luan.*', 'khach_hang.ho_va_ten', 'san_pham.ten_san_pham', 'san_pham.deleted_at', 'hinh_anh.hinh_anh')
            ->get();
        return view('AdminRocker.page.BinhLuan.QLbinhluan', compact('data_binhluan_baiviet', 'data_binhluan_sanpham'));
    }
    public function binhluan_baiviet()
    {
        $data_binhluan_baiviet = binh_luan_bai_viets::orderBy('created_at', 'desc')
            ->join('khach_hang', 'binh_luan_bai_viet.ma_khach_hang', '=', 'khach_hang.id')
            ->select('binh_luan_bai_viet.*', 'khach_hang.ho_va_ten', 'khach_hang.id')
            ->get();
        $compact = compact('data_binhluan_baiviet');

        return response()->json($compact);
    }
    public function binhluan_sanpham()
    {
        $data_binhluan_sanpham = BinhluanModel::orderBy('created_at', 'desc')
            ->join('khach_hang', 'binh_luan.ma_khach_hang', '=', 'khach_hang.id')
            ->join('san_pham', 'binh_luan.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select('binh_luan.*', 'khach_hang.ho_va_ten', 'khach_hang.id', 'san_pham.ten_san_pham', 'san_pham.id', 'san_pham.deleted_at', 'hinh_anh.hinh_anh')
            ->get();
        $compact = compact('data_binhluan_sanpham');

        return response()->json($compact);
    }
    public function xoa_binh_luan_baiviet($id)
    {
        $xoa_binh_luan_baiviet = binh_luan_bai_viets::find($id);
        if ($xoa_binh_luan_baiviet == null) {
            toastr()->error('Xoá Bình Luận Không Thành Công');
            return redirect('admin/binhluan');
        }else{
            $xoa_binh_luan_baiviet->delete();
            toastr()->success('Xoá Bình Luận Thành Công');
            return redirect('admin/binhluan');
        };
        
    }
    public function xoa_binh_luan_sanpham($id)
    {
        $xoa_binh_luan_sanpham = BinhluanModel::find($id);
        if ($xoa_binh_luan_sanpham == null) {
            toastr()->error('Xoá Bình Luận Không Thành Công');
            return redirect('admin/binhluan');
        }else{
            $xoa_binh_luan_sanpham->delete();
            toastr()->success('Xoá Bình Luận Thành Công');
            return redirect('admin/binhluan');
        };
        
    }
}
