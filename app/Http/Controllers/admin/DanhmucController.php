<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DanhmucModel;
use App\Models\LoaisanphamModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\Danh;
use App\Http\Requests\DanhmucRequests;

class DanhmucController extends Controller
{
    public function index()
    {
        return view('AdminRocker.page.DanhMuc.QuanLyDanhMuc');
    }

    public function HienThiDanhMuc()
    {
        $data_danhmuc = DanhmucModel::orderBy('id', 'desc')->get();
        $data_theloai = LoaisanphamModel::withTrashed()->get();
        $TrashDanhMuc = DanhmucModel::onlyTrashed()->get(); // du lieu dax soft delete

        foreach ($TrashDanhMuc as $danhmuc) {
            $danhmuc->disabled = $data_theloai->where('ma_danh_muc', $danhmuc->id)->isNotEmpty();
        }

        $compact = compact('data_danhmuc', 'TrashDanhMuc');

        if ($data_danhmuc->isEmpty()) {
            return response()->json($compact);
        } else {
            return response()->json($compact);
        }
    }

    public function ThemDanhMuc(DanhmucRequests $request)
    {
        $data = $request->all();
        $data['ten_danh_muc_slug'] = Str::slug($data['ten_danh_muc']);
        DanhmucModel::create($data);
        return response()->json([
            'status' => true,
            'message' => 'Thêm danh mục thành công'
        ]);
    }

    public function XoaDanhMuc(Request $request)
    {

        $xoa = DanhmucModel::find($request->id);
        $xoa->delete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa danh mục thành công !'
        ]);

    } // Xoa Mem


    public function CapNhatDanhMuc(Request $request)
    {
        $data = $request->all();
        $data['ten_danh_muc_slug'] = Str::slug($data['ten_danh_muc']);

        $DanhMuc = DanhMucModel::where('id', $request->id)->first();
        $DanhMuc->update($data);

        return response()->json([
            'status' => true,
            'message' => 'Cap nhật danh mục thành công'
        ]);
    }

    // ===================================================================================
    // =============================== TRASH =============================================
    // ===================================================================================


    public function PhucHoiDanhMuc(Request $request)
    {

        $PhucHoi = DanhmucModel::withTrashed()->where('id', $request->id);
        $PhucHoi->restore();
        return response()->json([
            'status' => true,
            'message' => 'Phục hồi danh mục thành công !!'
        ]);

    } // Phuc hoi

    public function PhucHoiTatCaDanhMuc()
    {
        DanhmucModel::withTrashed()->restore();
        return response()->json([
            'status' => true,
            'message' => 'Phục hồi danh mục thành công !!'
        ]);
    }

    public function XoaDanhMucVinhVien(Request $request)
    {

        $XoaCung = DanhmucModel::onlyTrashed()->where('id', $request->id);
        $XoaCung->forceDelete();
        return response()->json([
            'status' => true,
            'message' => 'Đã xóa danh mục thành công !'
        ]);

    } // Xoa cung





}