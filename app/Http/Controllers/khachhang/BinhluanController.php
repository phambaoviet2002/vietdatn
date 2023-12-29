<?php

namespace App\Http\Controllers\khachhang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BinhluanModel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\binhluansanphamRequest;

class BinhluanController extends Controller
{
    //
    public function binhluan_sanpham()
    {
        $data_binhluan_sanpham = BinhluanModel::orderBy('created_at', 'desc')
            ->join('khach_hang', 'binh_luan.ma_khach_hang', '=', 'khach_hang.id')
            ->select('binh_luan.*', 'khach_hang.ho_va_ten')
            ->get();
        $compact = compact('data_binhluan_sanpham');

        return response()->json($compact);
    }
    public function them_binhluan(binhluansanphamRequest $request)
    {
        $check = Auth::guard('khach_hang')->check();
        if ($check) {
            $khach_hang = Auth::guard('khach_hang')->user();
            $data_form =  $request->all();
            $data_form['ma_khach_hang']  = $khach_hang->id;
            $data_form['hien_thi']  = 1;
            $data_form['rating']  = 1;
            BinhluanModel::create($data_form);
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Bình luận thành công'
            ]);
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Cần phải đăng nhập để bình luận'
            ]);
        }
    }
    public function xoa_binhluan(Request $request)
    {
        $check = Auth::guard('khach_hang')->check();
        if ($check) {
            $khach_hang = Auth::guard('khach_hang')->user();

            $xoa_binh_luan_sanpham = BinhluanModel::find($request);

            if ($xoa_binh_luan_sanpham->ma_khach_hang==$khach_hang->id) {
                $xoa_binh_luan_sanpham->delete();
                return response()->json([
                    'status'    =>  true,
                    'message'   => 'xoá bình luận'
                ]);
            }else{
                
                return response()->json([
                    'status'    =>  false,
                    'message'   =>  'Cần phải đăng nhập để xoá bình luận'
                ]);
                
            };
            
        } else {
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Cần phải đăng nhập để bình luận'
            ]);
        }
    }
}
