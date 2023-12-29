<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\LoaisanphamModel;
use App\Models\DanhmucModel;
use App\Models\SanphamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\LoaisanphamRequest;

class LoaiSanphamController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.TheLoai.QuanLyTheLoai');
    }

    public function HienThiTheLoai() {
        $data_sanpham = SanphamModel::withTrashed()->get();
        $data_danhmuc = DanhmucModel::get();
        // $data_theloai = LoaisanphamModel::when($data_danhmuc->isNotEmpty(), function ($query) use ($data_danhmuc) {
        //     $query->whereIn('id', $data_danhmuc->pluck('id'));
        // })
        // ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
        // ->select('loai_san_pham.*', 'danh_muc.ten_danh_muc')
        // ->get();
        $data_theloai = LoaisanphamModel::orderBy('id', 'desc')
        ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
        ->select('loai_san_pham.*', 'danh_muc.ten_danh_muc')
        ->get();
        $TrashTheLoai = LoaisanphamModel::onlyTrashed()
        ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
        ->select('loai_san_pham.*', 'danh_muc.ten_danh_muc')
        ->get();

        foreach ($TrashTheLoai as $TheLoai) {
            $TheLoai->disabled = $data_sanpham->where('ma_loai', $TheLoai->id)->isNotEmpty();
        }


        $compact = compact('data_danhmuc', 'data_theloai', 'TrashTheLoai');

        if ($data_theloai->isEmpty()) {
			return response()->json( $compact );
        } else {
            return response()->json( $compact );
        }
    }

    public function ThemTheLoai(LoaisanphamRequest $request) {
        $data =  $request->all();
        $data['ten_loai_slug'] = Str::slug($data['ten_loai']);
        LoaisanphamModel::create($data);
        return response()->json([
            'status'    =>  true,
            'message'   =>  'Thêm thể loại thành công'
        ]);
        
    }

    public function XoaTheLoai(Request $request) {
        
		$xoa = LoaisanphamModel::find($request->id);
		$xoa->delete();

        return response()->json([
            'status'    =>      true,
            'message'   =>      'Đã xóa thể loại thành công !'
        ]);
    }

    public function CapNhatTheLoai(Request $request) {
        $data = $request->all();
        $data['ten_loai_slug'] = Str::slug($data['ten_loai']);

        $TheLoai = LoaisanphamModel::where('id', $request->id)->first();
        $TheLoai->update($data);

        return response()->json([
            'status'    =>  true,
            'message'   =>  'Cap nhật thể loại thành công'
        ]);       
    }


    // ===================================================================================
    // =============================== TRASH =============================================
    // ===================================================================================




    public function PhucHoiTheLoai(Request $request) {
         
        $PhucHoi = LoaisanphamModel::onlyTrashed()->where('id', $request->id);
		$PhucHoi->restore();  
        return response()->json([
            'status'    =>      true,
            'message'   =>      'Phục hồi thể loại thành công !!'
        ]);
        
    }// Phuc hoi

    public function PhucHoiTatCaTheLoai()
    {
        LoaisanphamModel::onlyTrashed()->restore();
        return response()->json([
            'status'    =>      true,
            'message'   =>      'Phục hồi danh mục thành công !!'
        ]);
    }

    public function XoaTheLoaiVinhVien(Request $request) {
         
        $XoaCung = LoaisanphamModel::onlyTrashed()->where('id', $request->id);
		$XoaCung->forceDelete();  
        return response()->json([
            'status'    =>      true,
            'message'   =>      'Đã xóa thể loại thành công !'
        ]);
        
    }// Xoa cung


}