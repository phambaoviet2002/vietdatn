<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatTaikhoanRequest;
use App\Http\Requests\CapNhatTKQTRequest;
use App\Http\Requests\TKQuanTriRequest;
use App\Models\TaiKhoanModel;
use Illuminate\Http\Request;
use App\Models\PhanquyenModel;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class QLNhanVienController extends Controller
{
    //
    public function QuanLyNhanVien()
    {
        return view('AdminRocker.page.NhanVien.QuanLyNhanVien');
    }


    public function DuLieuNhanVien()
    {
        $data_taikhoan = TaiKhoanModel::all();
        $data_phanquyen = PhanquyenModel::all();
        $TaiKhoanDangNhap = Auth::guard('tai_khoan')->user();

        $compact = compact('data_taikhoan', 'data_phanquyen', 'TaiKhoanDangNhap');

        return response()->json($compact);
    }

    public function ThemNhanVien(TKQuanTriRequest $request)
    {
        // dd( $request);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
       
        TaiKhoanModel::create($data);
        
        return response()->json([
            'status' => true,
            'message' => 'Thêm thành công'
        ]);
    }

    public function XoaNhanVien(Request $request)
    {
        TaiKhoanModel::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa liên hệ thành công !'
        ]);
    }

    public function CapNhatNhanVien(CapNhatTKQTRequest $request)
    {
        $data = $request->all();
        $khach_hang = TaiKhoanModel::where('id', $request->id)->first();
        $khach_hang->update($data);
        return response()->json([
            'status' => true,
            'message' => 'Cap nhat thành công'
        ]);
    }
}
