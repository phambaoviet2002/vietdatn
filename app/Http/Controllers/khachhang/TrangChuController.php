<?php

namespace App\Http\Controllers\khachhang;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DanhmucModel;
use App\Models\BaivietModel;
use App\Models\LoaisanphamModel;
use App\Models\SanphamModel;
use App\Models\HinhanhModel;
use App\Models\SanPhamYeuThich;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BannerModel;

class TrangChuController extends Controller
{
    public function TrangChu()
    {
        $san_pham_yeu_thich = SanPhamYeuThich::join('san_pham', 'san_pham_yeu_thich.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id') // Nối bảng loai_san_pham
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id') // Nối bảng danh_muc
            ->select('san_pham.id as ma_san_pham', 'san_pham.deleted_at', 'san_pham.ten_san_pham', 'san_pham.ten_san_pham_slug', 'san_pham.gia_san_pham', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug', DB::raw('COUNT(san_pham_yeu_thich.ma_san_pham) AS so_lan_xuat_hien'))
            ->groupBy('san_pham.id', 'san_pham.ten_san_pham', 'san_pham.deleted_at', 'san_pham.gia_san_pham', 'san_pham.ten_san_pham_slug', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug')
            ->orderByDesc('so_lan_xuat_hien')
            ->limit(8)
            ->get();
        // dd($san_pham_yeu_thich);
        // Lấy danh mục
        $danhMuc = DanhmucModel::where('deleted_at', null)->get();
        // Lấy 8 sản phẩm yêu thích xuất hiện nhiều nhất cho mỗi danh mục
        $san_pham_danh_muc = [];
        foreach ($danhMuc as $danhmuc) {
            $san_pham_yeu_thich_danh_muc = SanPhamYeuThich::join('san_pham', 'san_pham_yeu_thich.ma_san_pham', '=', 'san_pham.id')
                ->join('hinh_anh', function ($join) {
                    $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                        ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
                })
                ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
                ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
                ->where('danh_muc.id', $danhmuc->id)
                ->select('san_pham.id as ma_san_pham', 'san_pham.trang_thai', 'san_pham.ten_san_pham', 'san_pham.gia_san_pham', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug', 'san_pham.ten_san_pham_slug', 'san_pham.deleted_at', DB::raw('COUNT(san_pham_yeu_thich.ma_san_pham) AS so_lan_xuat_hien'), 'danh_muc.ten_danh_muc_slug AS ten_danh_muc_slug')
                ->groupBy('san_pham.id', 'san_pham.ten_san_pham', 'san_pham.trang_thai', 'san_pham.gia_san_pham', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug', 'san_pham.ten_san_pham_slug', 'san_pham.deleted_at')
                ->orderByDesc('so_lan_xuat_hien')
                ->limit(8) // Thay đổi từ limit thành take
                ->get();

            $san_pham_danh_muc[$danhmuc->id] = $san_pham_yeu_thich_danh_muc;
        }

        // dd($san_pham_danh_muc);

        // sản phẩm mới
        $san_pham_moi = Sanphammodel::select('san_pham.*', 'hinh_anh.hinh_anh', 'danh_muc.ten_danh_muc_slug', 'loai_san_pham.ten_loai_slug')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id') // Nối bảng loai_san_pham
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
            ->orderByDesc('san_pham.created_at')
            ->paginate(10);
        // dd($san_pham_moi);
        $data_tintuc = BaivietModel::orderBy('created_at', 'desc')
        ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
        ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')
            ->limit(3)->get();

         // sản phẩm đặc biệt
         $san_pham_dac_biet = Sanphammodel::where('dat_biet', 1)
         ->select('san_pham.*', 'hinh_anh.hinh_anh', 'danh_muc.ten_danh_muc_slug', 'loai_san_pham.ten_loai_slug')
         ->join('hinh_anh', function ($join) {
             $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                 ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
         })
         ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id') // Nối bảng loai_san_pham
         ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
         ->paginate(8);
        // dd($san_pham_dac_biet);

        $data_banner=BannerModel::orderBy('created_at', 'desc')
        ->join('bai_viet', 'banner.ma_bai_viet', '=', 'bai_viet.id')
        ->select('banner.*', 'bai_viet.ten_bai_viet','bai_viet.mo_ta_ngan','bai_viet.loai_tin')
        ->limit(3)->get();
        return view('Trang-Khach-Hang.page.TrangChu', compact('san_pham_yeu_thich', 'san_pham_danh_muc', 'san_pham_moi', 'data_tintuc','san_pham_dac_biet', 'data_banner'));
    
        }

    public function SanPhamTatCa()
    {
        $san_pham_tat_ca = DanhmucModel::orderBy('created_at', 'desc')
            ->join('loai_san_pham', 'danh_muc.id', '=', 'loai_san_pham.ma_danh_muc')
            ->join('san_pham', 'loai_san_pham.id', '=', 'san_pham.ma_loai')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select('san_pham.*', 'loai_san_pham.ten_loai as ten_loai_san_pham', 'loai_san_pham.ten_loai_slug', 'hinh_anh.hinh_anh', 'danh_muc.ten_danh_muc_slug')
            ->paginate(9);

            // dd( $san_pham_tat_ca);
        $tin_khuyen_mai = BaivietModel::orderBy('created_at', 'desc')
            ->where('loai_tin', '1')
            ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
            ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')->limit(5)->get();
        // dd($san_pham_tat_ca );
        return view('Trang-Khach-Hang.page.SanPhamTatCa', compact('san_pham_tat_ca', 'tin_khuyen_mai'));
    }

    public function SanPhamDanhMuc($ten_danh_muc_slug)
    {
        $san_pham_danh_muc = DanhmucModel::where('ten_danh_muc_slug', $ten_danh_muc_slug)
            ->orderBy('created_at', 'desc')
            ->join('loai_san_pham', 'danh_muc.id', '=', 'loai_san_pham.ma_danh_muc')
            ->join('san_pham', 'loai_san_pham.id', '=', 'san_pham.ma_loai')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->select('san_pham.*', 'loai_san_pham.ten_loai_slug', 'hinh_anh.hinh_anh', 'danh_muc.ten_danh_muc_slug')
            ->paginate(9);
        // dd($san_pham_danh_muc);
        $tin_khuyen_mai = BaivietModel::orderBy('created_at', 'desc')
            ->where('loai_tin', '1')
            ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
            ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')->limit(5)->get();
        return view("Trang-Khach-Hang.page.SanPhamDanhMuc", compact('san_pham_danh_muc', 'tin_khuyen_mai'));
    }

    public function SanPhamTheLoai($ten_danh_muc_slug, $ten_loai_slug)
    {
        $san_pham_the_loai = LoaisanphamModel::where('ten_loai_slug', $ten_loai_slug)
            ->orderBy('created_at', 'desc')
            ->join('san_pham', 'loai_san_pham.id', '=', 'san_pham.ma_loai')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->join('danh_muc', 'danh_muc.id', '=', 'loai_san_pham.ma_danh_muc')
            ->where('danh_muc.ten_danh_muc_slug', $ten_danh_muc_slug)
            ->select('san_pham.*', 'loai_san_pham.ten_loai_slug', 'hinh_anh.hinh_anh', 'danh_muc.ten_danh_muc_slug')
            ->paginate(9);
        // dd( $san_pham_the_loai);
        $tin_khuyen_mai = BaivietModel::orderBy('created_at', 'desc')
            ->where('loai_tin', '1')
            ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
            ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')->limit(5)->get();
        return view('Trang-Khach-Hang.page.SanPhamTheLoai', compact('san_pham_the_loai', 'tin_khuyen_mai'));
    }


    public function SanPhamChiTiet($ten_danh_muc_slug, $ten_loai_slug, $ten_san_pham_slug, $id)
    {
        $san_pham_chi_tiet = SanphamModel::
            // where('ten_danh_muc_slug', $ten_danh_muc_slug)
            // ->join('loai_san_pham', 'danh_muc.id', '=', 'loai_san_pham.ma_danh_muc')
            // ->where('loai_san_pham.ten_loai_slug', $ten_loai_slug)
            // ->join('san_pham', 'loai_san_pham.id', '=', 'san_pham.ma_loai')
            // ->where('san_pham.ten_san_pham_slug', $ten_san_pham_slug)
            where('id', $id)
            ->first();

        $hinh_anh_san_pham = HinhAnhModel::where('ma_san_pham', $san_pham_chi_tiet->id)->get();
        $san_pham_yeu_thich = SanPhamYeuThich::join('san_pham', 'san_pham_yeu_thich.ma_san_pham', '=', 'san_pham.id')
            ->join('hinh_anh', function ($join) {
                $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                    ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id') // Nối bảng loai_san_pham
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id') // Nối bảng danh_muc
            ->select('san_pham.id as ma_san_pham', 'san_pham.deleted_at', 'san_pham.ten_san_pham', 'san_pham.ten_san_pham_slug', 'san_pham.gia_san_pham', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug', DB::raw('COUNT(san_pham_yeu_thich.ma_san_pham) AS so_lan_xuat_hien'))
            ->groupBy('san_pham.id', 'san_pham.ten_san_pham', 'san_pham.deleted_at', 'san_pham.gia_san_pham', 'san_pham.ten_san_pham_slug', 'san_pham.giam_gia_san_pham', 'hinh_anh.hinh_anh', 'loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug')
            ->orderByDesc('so_lan_xuat_hien')
            ->limit(8)
            ->get();
       
            return view('Trang-Khach-Hang.page.SanPhamChiTiet', compact('san_pham_chi_tiet', 'hinh_anh_san_pham', 'san_pham_yeu_thich'));
        
        

    }

    public function GioHang()
    {
        return view('Trang-Khach-Hang.page.GioHang');
    }
    public function ThanhToan()
    {
        return view('Trang-Khach-Hang.page.ThanhToan');
    }
    public function TinTuc()
    {
        return view('Trang-Khach-Hang.page.TinTuc');
    }
    public function TinTucChiTiet()
    {
        return view('Trang-Khach-Hang.page.TinTucChiTiet');
    }

    public function GioiThieu()
    {
        return view('Trang-Khach-Hang.page.GioiThieu');
    }


    public function TimKiemPost(Request $request)
    {
        $search = $request->search;
        $tin_khuyen_mai = BaivietModel::orderBy('created_at', 'desc')
        ->where('loai_tin', '1')
        ->join('tai_khoan', 'bai_viet.ma_nhan_vien', '=', 'tai_khoan.id')
        ->select('bai_viet.*', 'tai_khoan.ten_tai_khoan')->limit(5)->get();
        // Tìm kiếm sản phẩm theo tên
        $cleaned_search = preg_replace('/[^\p{L}\p{N}\s]/u', '', $search);

        $ds_tim_kiem = SanphamModel::where('ten_san_pham', 'like', '%' . $cleaned_search . '%')
        ->join('hinh_anh', function ($join) {
        $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
            ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
        })
        ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
        ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
        ->select('san_pham.*','loai_san_pham.ten_loai_slug', 'danh_muc.ten_danh_muc_slug')
        ->paginate(9);

    //  dd($ds_tim_kiem);

        // Trả về chế độ xem với các biến được nén
        return view('Trang-Khach-Hang.page.TimKiemSanPham', compact('ds_tim_kiem','tin_khuyen_mai'));
    }

    public function TimKiemNangcao(Request $request){
        $tim_kiem = $request->input('tim_kiem');
        $cleaned_search = preg_replace('/[^\p{L}\p{N}\s]/u', '', $tim_kiem);

        $ds_tim_kiem = SanphamModel::where('ten_san_pham', 'like', '%' . $cleaned_search . '%')
            ->join('hinh_anh', function ($join) {
            $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
            })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id')
            ->limit(3)
            ->get();
            
            return response()->json([
                'status' => true,
                'ds_tim_kiem' => $ds_tim_kiem,
            ]);
    }



    public function locSanPham(Request $request)
    {
        $theLoaiIds = $request->input('the_loai_ids', []);
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        // Bắt đầu câu truy vấn
        $query = SanphamModel::join('hinh_anh', function ($join) {
            $join->on('san_pham.id', '=', 'hinh_anh.ma_san_pham')
                ->whereRaw('hinh_anh.id = (select min(id) from hinh_anh where hinh_anh.ma_san_pham = san_pham.id)');
        })
            ->join('loai_san_pham', 'san_pham.ma_loai', '=', 'loai_san_pham.id')
            ->join('danh_muc', 'loai_san_pham.ma_danh_muc', '=', 'danh_muc.id');

        // Kiểm tra có ID thể loại hay không
        if (!empty($theLoaiIds)) {
            $query->whereIn('ma_loai', $theLoaiIds);
        }
        // Kiểm tra có minPrice và maxPrice hay không
        if ($minPrice !== null && $maxPrice !== null) {
            $query->whereBetween('giam_gia_san_pham', [$minPrice, $maxPrice]);
        }

        // Thực hiện truy vấn và lấy dữ liệu
        $ds_loc = $query->get();
// dd($ds_loc);
        // Hiển thị dữ liệu (lưu ý: hãy xem xét cách bạn muốn xử lý dữ liệu sau khi truy vấn)

        return response()->json([
            'status' => true,
            'ds_loc' => $ds_loc,
            'message' => 'Lọc sản phẩm thành công',
        ]);
    }
}
