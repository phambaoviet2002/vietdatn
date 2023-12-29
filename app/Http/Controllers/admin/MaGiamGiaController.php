<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MaGiamGiaModel;
use App\Http\Requests\MaGiamGiaRequest;
use App\Http\Requests\capnhatMagiamgiaRequest;
class MaGiamGiaController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.MaGiamGia.MaGiamGia');
    }
    public function lay_ma_giam_gia()
    {
        $data_ma_giam_gia = MaGiamGiaModel::orderBy('created_at', 'desc')
            ->get();
        $compact = compact('data_ma_giam_gia');
        return response()->json($compact);
    }
    public function them_ma_giam_gia(MaGiamGiaRequest $request)
    {
        $data_form =  $request->all();
        MaGiamGiaModel::create($data_form);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Thêm mã giảm giá thành công'
        ]);
    }

    public function cap_nhat_ma_giam_gia(capnhatMagiamgiaRequest $request)
    {
        $data_ma_giam_gia = MaGiamGiaModel::where('id',$request->id)->first();
        $data_ma_giam_gia->so_luong =  $request->so_luong;
        $data_ma_giam_gia->tien_giam_gia =  $request->tien_giam_gia;
        $data_ma_giam_gia->save();

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Cập nhật mã giảm giá thành công'
        ]);
    }
    public function xoa_ma_giam_gia(Request $request)
    {
        $data_ma_giam_gia = MaGiamGiaModel::find($request->id);
        $data_ma_giam_gia->delete();
        
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Xoá m mã giảm giá thành công'
        ]);
    }
}
