<?php

namespace App\Http\Controllers\khachhang;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\binh_luan_bai_viets;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\binhluantintucRequest;

class BinhluanTintucController extends Controller
{
    //
    public function binhluan_baiviet()
    {
        $data_binhluan_baiviet = binh_luan_bai_viets::orderBy('created_at', 'desc')
        ->join('khach_hang', 'binh_luan_bai_viet.ma_khach_hang', '=', 'khach_hang.id')       
        ->select('binh_luan_bai_viet.*', 'khach_hang.ho_va_ten')
        ->get();
        $compact =compact('data_binhluan_baiviet');
       
        return response()->json($compact);

    }
    public function them_binhluan(binhluantintucRequest $request)
    {
        $check =Auth::guard('khach_hang')->check();
        if($check){
            $khach_hang = Auth::guard('khach_hang')->user();
            $data_form =  $request->all();
            $data_form['ma_khach_hang']  = $khach_hang->id;
            $data_form['hien_thi']  = 1;
            $data_form['rating']  = 1;
            binh_luan_bai_viets::create($data_form);
            return response()->json([
                'status'    =>  true,
                'message'   =>  'Bình luận thành công'
            ]);
        }else{
            return response()->json([
                'status'    =>  false,
                'message'   =>  'Cần phải đăng nhập để bình luận'
            ]);
        }
        
    }
    
    
        
}
