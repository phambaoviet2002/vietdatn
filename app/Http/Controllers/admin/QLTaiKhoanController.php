<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CapNhatTaikhoanRequest;
use App\Http\Requests\TaikhoanRequest;
use App\Models\KhachHangModel;
use App\Models\PhanquyenModel;
use Illuminate\Http\Request;

class QLTaiKhoanController extends Controller
{
    public function QuanLyTaiKhoan() {
        return view('AdminRocker.page.QuanLyTaiKhoan');
    }
    
    public function DuLieuTaiKhoan() {
        $data_taikhoan = KhachHangModel::all();
        $data_phanquyen = PhanquyenModel::all();

        $compact = compact('data_taikhoan', 'data_phanquyen');

        return response()->json( $compact );
    }

    public function ThemTaiKhoan(TaikhoanRequest $request) {
        $data =  $request->all();
        $data['password'] = bcrypt($data['password']);
        KhachHangModel::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Thêm thành công'
        ]);

    }

    public function XoaTaiKhoan(Request $request) {
        KhachHangModel::where('id', $request->id)->update(
            [
                'loai_tai_khoan' => -1
            ]
        );     
        return response()->json([
            'status'    =>      true,
            'message'   =>      'Đã xóa liên hệ thành công !'
        ]);
    }

    public function CapNhatTaiKhoan(CapNhatTaikhoanRequest $request) {
        $data =  $request->all();
        $khach_hang = KhachHangModel::where('id', $request->id)->first();
        $khach_hang->update($data); 
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Cap nhat thành công'
        ]);      
    }
}
