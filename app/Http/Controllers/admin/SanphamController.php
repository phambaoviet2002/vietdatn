<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SanphamRequest;
use App\Models\DanhmucModel;
use App\Models\HinhanhModel;
use App\Models\HoadonchitietModel;
use App\Models\LoaisanphamModel;
use App\Models\SanphamModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;


class SanphamController extends Controller
{
	public function sanpham()
	{
		$data_HDCT = HoadonchitietModel::get();
		$data_hinhanh = HinhanhModel::all();
		$data_Loaisanpham = LoaisanphamModel::get();
		$data_danhmuc = DanhmucModel::get();

		$sanPhamsWithInfo = SanphamModel::orderBy('id', 'desc')->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
		->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
		->leftJoin('hinh_anh', 'san_pham.id', '=', 'hinh_anh.ma_san_pham')
		->select('san_pham.*', 'loai_san_pham.ten_loai', 'danh_muc.ten_danh_muc', 'hinh_anh.hinh_anh')
		->paginate(10);

		$TrashSanPhamsWithInfo = SanphamModel::orderBy('id', 'desc')->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
		->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
		->leftJoin('hinh_anh', 'san_pham.id', '=', 'hinh_anh.ma_san_pham')
		->select('san_pham.*', 'loai_san_pham.ten_loai', 'danh_muc.ten_danh_muc', 'hinh_anh.hinh_anh')
		->onlyTrashed()
		->paginate(10);

		$StatusSanPhamsWithInfo = SanphamModel::orderBy('id', 'desc')->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
		->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
		->leftJoin('hinh_anh', 'san_pham.id', '=', 'hinh_anh.ma_san_pham')
		->select('san_pham.*', 'loai_san_pham.ten_loai', 'danh_muc.ten_danh_muc', 'hinh_anh.hinh_anh')
		->where('trang_thai', 0)
		->paginate(10);

		foreach ($TrashSanPhamsWithInfo as $san_pham) {
			$san_pham->disabled = $data_HDCT->where('ma_san_pham', $san_pham->id)->isNotEmpty();
		}
		
		if ($sanPhamsWithInfo->isEmpty()) {
			return view(
				'AdminRocker.page.SanPham.QuanLySanPham',
				compact('sanPhamsWithInfo', 'TrashSanPhamsWithInfo', 'StatusSanPhamsWithInfo', 'data_hinhanh', 'data_Loaisanpham', 'data_danhmuc')
			);
		} else {
			return view(
				'AdminRocker.page.SanPham.QuanLySanPham',
				compact('sanPhamsWithInfo', 'TrashSanPhamsWithInfo', 'StatusSanPhamsWithInfo', 'data_hinhanh', 'data_Loaisanpham', 'data_danhmuc')
			);
		}

	}

	public function them_sanpham(Request $request)
	{
		$data = $request->all();
		$data['ten_san_pham_slug'] = Str::slug($data['ten_san_pham']);
		if($data['phan_tram_giam_gia'] == 0 || $data['phan_tram_giam_gia'] == null) {
			$data['giam_gia_san_pham'] = $data['gia_san_pham'];
		} else {
			$data['giam_gia_san_pham'] = $data['gia_san_pham'] * (1 - $data['phan_tram_giam_gia'] / 100) ;
		}

		$sanpham = SanphamModel::create($data);

		$t_ = $sanpham->id;
		$get_image = $request->file('hinh_anh');

		if ($get_image) {
			foreach ($get_image as $image) {
				$get_name_image = $image->getClientOriginalName();
				$images = Image::make($image->getRealPath());
				$images->resize(300, 250);

				$images->save(public_path('img/' . $get_name_image));

				$x = new HinhanhModel;
				$x->hinh_anh = $get_name_image;
				$x->ma_san_pham = $t_;

				$x->save();
			}
		}

		toastr()->success('Sản phẩm đã được thêm thành công.');
		return redirect('admin/sanpham');

	}

	public function xoa_sanpham()
	{
		$id = $_GET['idsp'];
		$xoa = SanphamModel::find($id);
		$xoa->delete();
	}

	public function cn_sanpham_($id, Request $request)
	{
		$sanpham = SanphamModel::find($id);

		$get_image = $request->file('hinh_anh');
		if ($get_image) {
			foreach ($get_image as $image) {
				$get_name_image = $image->getClientOriginalName();
				$images = Image::make($image->getRealPath());
				$images->resize(300, 250);

				$images->save(public_path('img/' . $get_name_image));

				$x = new HinhanhModel;
				$x->hinh_anh = $get_name_image;
				$x->ma_san_pham = $id;

				$x->save();

			}
		}

		$sanpham->ten_san_pham = $request->ten_san_pham;
		$sanpham->ten_san_pham_slug = Str::slug($sanpham->ten_san_pham);
		$sanpham->ma_loai = $request->ma_loai;
		$sanpham->gia_san_pham = $request->gia_san_pham;
		$sanpham->phan_tram_giam_gia = $request->phan_tram_giam_gia;
		if($request->phan_tram_giam_gia == 0 || $request->phan_tram_giam_gia == null) {
			$sanpham->giam_gia_san_pham = $request->gia_san_pham;
		} else {
			$sanpham->giam_gia_san_pham = $request->gia_san_pham * (1 - $request->phan_tram_giam_gia / 100) ;
		}
		$sanpham->so_luong = $request->so_luong;
		$sanpham->luot_xem = $request->luot_xem;
		$sanpham->dat_biet = $request->dat_biet;
		$sanpham->mo_ta = $request->mo_ta;

		$sanpham->save();

		toastr()->success('Sản phẩm đã được cập nhật thành công.');
		return redirect('admin/sanpham');

	}

	public function toggleStatus()
	{
		$id = $_GET['idsta'];
		$trangthai_sanpham = SanphamModel::find($id);
		$trangthai = $trangthai_sanpham->trang_thai;
		if ($trangthai == 1) {
			$trangthai = 0;
		} else {
			$trangthai = 1;
		}

		$trangthai_sanpham->trang_thai = $trangthai;
		$trangthai_sanpham->save();
		echo $trangthai;
	}


	// ===================================================================================
	// =============================== TRASH =============================================
	// ===================================================================================
	

	public function PhucHoiSanPham()
	{
		$id = $_GET['idrestore'];
		$PhucHoi = SanphamModel::onlyTrashed()->where('id', $id);
		$PhucHoi->restore();
	}// Phuc hoi

	public function PhucHoiTatCaSanPham()
	{
		SanphamModel::onlyTrashed()->restore();
		// return redirect('admin/sanpham');
	}// Phuc hoi

	public function XoaSanPhamVinhVien() {
		$id = $_GET['idtrashsp'];
		$XoaCung = SanphamModel::onlyTrashed()->where('id', $id);
		$XoaCung->forceDelete();  
	}// Xoa cung
}