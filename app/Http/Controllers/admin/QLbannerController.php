<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaivietModel;
use App\Models\BannerModel;
use Intervention\Image\ImageManagerStatic as Image;
class QLbannerController extends Controller
{
    public function index()
    { 
        $data_bai_viet = BaivietModel::orderBy('created_at', 'desc')->get();
        $data_banner = BannerModel::orderBy('created_at', 'desc')
        ->join('bai_viet', 'banner.ma_bai_viet', '=', 'bai_viet.id')
        ->select('banner.*', 'bai_viet.ten_bai_viet' )
        ->get();
        return view('AdminRocker.page.Banner.Banner',compact('data_bai_viet','data_banner'));
    }

    public function them_banner( Request $request)
    {
        $data_form =  $request->all();
        $data_form['hien_thi']=1;
        $get_image = $request->file('anh_banner');
        $get_name_image = $get_image->getClientOriginalName();
        $images = Image::make($get_image->getRealPath());

        $images->save(public_path('img/' . $get_name_image));

        $data_form['anh_banner']  = $get_name_image;
        // var_dump($data_form);
        BannerModel::create($data_form);

        toastr()->success('Tạo banner Thành Công');
        return redirect('admin/banner');
    }
    public function capnhat_banner(Request $request, $id)
    {
        $capnhat = BannerModel::find($id);
        $data_capnhat = $request->all();
        $capnhat->ma_bai_viet = $data_capnhat['ma_bai_viet'];
        $get_image = $request->file('anh_banner');
        $get_name_image = $get_image->getClientOriginalName();
        $images = Image::make($get_image->getRealPath());
        $images->save(public_path('img/' . $get_name_image));

        $capnhat->anh_banner = $get_name_image;

        $capnhat->save();

        toastr()->success('cập nhật banner Thành Công');

        return redirect('admin/banner');
    }

    public function xoa_banner($id)
    {
        $xoa_banner = BannerModel::find($id);
        if ($xoa_banner == null) {
            toastr()->error('Có lỗi xãy ra!!');
            return redirect('admin/banner');
        }else{ 
            $xoa_banner->delete();
            toastr()->success('Xoá bài viết Thành Công');
            return redirect('admin/banner');}
       
    }
    // public function lay_data()
    // {
    //     $data_bai_viet = BaivietModel::orderBy('created_at', 'desc')->get();
    //     $data_banner = BannerModel::orderBy('created_at', 'desc')
    //     ->join('bai_viet', 'banner.ma_bai_viet', '=', 'bai_viet.id')
    //     ->select('banner.*', 'bai_viet.ten_bai_viet')
    //     ->get();
    //     $compact = compact('data_bai_viet','data_banner');
    //     return response()->json($compact);
    // }


}
