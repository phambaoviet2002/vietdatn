<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BaivietRequest;
use Illuminate\Http\Request;
use App\Models\BaivietModel;
use App\Models\BannerModel;
use App\Models\KhachHangModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\binh_luan_bai_viets;

class BaivietController extends Controller
{
    public function baiviet()
    {
        $data_baiviet = BaivietModel::orderBy('created_at', 'desc')
            ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
            ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')
            ->get();

        return view('AdminRocker.page.BaiViet.index', compact('data_baiviet'));
    }
    public function taobaiviet(Request $request)
    {

        $khach_hang = Auth::guard('tai_khoan')->user();
        $data_form = $request->all();
        $data_form['ten_bai_viet_slug'] = Str::slug($data_form['ten_bai_viet']);
        $data_form['ma_nhan_vien']  = $khach_hang->id;
        $data_form['hien_thi']  = 1;
        $get_image = $request->file('hinh_anh');
        $get_name_image = $get_image->getClientOriginalName();
        $images = Image::make($get_image->getRealPath());

        $images->save(public_path('img/' . $get_name_image));

        $data_form['hinh_anh']  = $get_name_image;
        BaivietModel::create($data_form);
        toastr()->success('Tạo bài viết Thành Công');
        return redirect('admin/baiviet');
    }
    public function xoa_baiviet($id)
    {
        $xoa_baiviet = BaivietModel::find($id);
        $lien_ket_banner=BannerModel::where('ma_bai_viet',$id)->first();
        $binh_luan=binh_luan_bai_viets::where('ma_bai_viet',$id)->get();
        if ($xoa_baiviet == null) {
            toastr()->error('Có lỗi xãy ra!!');
            return redirect('admin/baiviet');
        }elseif($lien_ket_banner){
            if($xoa_baiviet->id ===$lien_ket_banner->ma_bai_viet){
                toastr()->error('Bài Viết đã được liên kết với Banner');
                return redirect('admin/baiviet');
            }else{
                if($binh_luan){
                    foreach($binh_luan as $value){
                        $value->delete();
                    }
                }
                $xoa_baiviet->delete();
                toastr()->success('Xoá bài viết Thành Công');
                return redirect('admin/baiviet');
            }
            
        }else{
            if($binh_luan){
                foreach($binh_luan as $value){
                    $value->delete();
                }
            }
            $xoa_baiviet->delete();
            toastr()->success('Xoá bài viết Thành Công');
            return redirect('admin/baiviet');
        }
        
    }

    public function capnhat_baiviet(Request $request, $id)
    {
        $capnhat = BaivietModel::find($id);


        $data_capnhat = $request->all();
        $data_capnhat['ten_bai_viet_slug'] = Str::slug($data_capnhat['ten_bai_viet']);

        $capnhat->ten_bai_viet = $data_capnhat['ten_bai_viet'];
        $capnhat->ten_bai_viet_slug = $data_capnhat['ten_bai_viet_slug'];
        $capnhat->mo_ta_ngan = $data_capnhat['mo_ta_ngan'];
        $capnhat->noi_dung = $data_capnhat['noi_dung'];
        $capnhat->loai_tin = $data_capnhat['loai_tin'];

        $get_image = $request->file('hinh_anh');
        $get_name_image = $get_image->getClientOriginalName();
        $images = Image::make($get_image->getRealPath());
        $images->save(public_path('img/' . $get_name_image));

        $capnhat->hinh_anh = $get_name_image;

        $capnhat->save();

        toastr()->success('cập nhật bài viết Thành Công');

        return redirect('admin/baiviet');
    }
    public function doitrangthai($id)
    {

        $baiviet = BaivietModel::where('id', $id)->first();
        if ($baiviet) {
            if ($baiviet->hien_thi == 1) {
                $baiviet->hien_thi == 0;
            } else {
                $baiviet->hien_thi == 1;
            };
        };
        toastr()->success('cập nhật bài viết Thành Công');

        return redirect('admin/baiviet');
        // $hienthi = $baiviet->hien_thi;
        // if ($hienthi == 1) {
        // 	$hienthi = 0;
        // } else {
        // 	$hienthi = 1;
        // }

        // $$baiviet->hien_thi = $hienthi;
        // $baiviet->save();

    }
    public function restore()
    {
        
        BaivietModel::onlyTrashed()->restore();
        // foreach ($khoiphuc as $baiviet) {
        //     $id = $baiviet->id;
        //     // BaivietModel::withTrashed()->find($id)->restore();
        //     BaivietModel::onlyTrashed()->where('id', $id)->restore();
        // }
        toastr()->success('Phục hồi bài viết Thành Công');
        return redirect('admin/baiviet');
    }

    public function showbaiviet($id)
    {
        $data_baiviet = BaivietModel::where('loai_tin', '=', $id)
            ->orderBy('created_at', 'desc')->paginate(5);

        foreach ($data_baiviet as $baiviet) {
            $user = KhachHangModel::find($baiviet->ma_khach_hang);
            $baiviet->ma_khach_hang = $user->ho_va_ten;
        }

        return view('Trang-Khach-Hang.page.TinTuc', compact('data_baiviet'));
        //    var_dump($data_baiviet);
    }
}
