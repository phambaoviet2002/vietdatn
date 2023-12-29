<?php

use App\Http\Controllers\admin\BaivietController;
use App\Http\Controllers\admin\DanhmucController;
use App\Http\Controllers\admin\hinhanhController;
use App\Http\Controllers\admin\LoaiSanphamController;
use App\Http\Controllers\admin\QLNhanVienController;
use App\Http\Controllers\admin\QLTaiKhoanController;
use App\Http\Controllers\admin\SanphamController;
use App\Http\Controllers\admin\TaiKhoanController;
use App\Http\Controllers\admin\QLHoaDonController;
use App\Http\Controllers\admin\QLBinhluanController;
use App\Http\Controllers\admin\MaGiamGiaController;
use App\Http\Controllers\admin\QLbannerController;
use App\Http\Controllers\khachhang\GioHangController;
use App\Http\Controllers\admin\ThongKeController;
use App\Http\Controllers\khachhang\TrangChuController;
use App\Http\Controllers\khachhang\KhachHangController;
use App\Http\Controllers\khachhang\LienHeController;
use App\Http\Controllers\khachhang\TinTucController;
use App\Http\Controllers\khachhang\BinhluanTintucController;
use App\Http\Controllers\khachhang\BinhluanController;

use App\Http\Controllers\khachhang\SanPhamYeuThichController;
use App\Http\Controllers\khachhang\ThanhToanControllerr;
use App\Models\SanPhamYeuThich;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'name' => 'AdminRocker'], function () {

  Route::middleware(['CheckAdminAccess'])->group(function () {


    // nhan vien ban hang  -qlsp-lh-kh-dh
    Route::middleware(['NhanVienMiddleware'])->group(function () {

      // HOÁ ĐƠN --------------------

      Route::group(['prefix' => '/hoa-don'], function () {
        Route::get('/', [QLHoaDonController::class, 'index']);
        Route::get('/du-lieu', [QLHoaDonController::class, 'DuLieuHoaDon']);
        Route::get('/hoa-don-chi-tiet/{id}', [QLHoaDonController::class, 'HoaDonChiTiet']);
        Route::post('/them-san-pham-hdct', [QLHoaDonController::class, 'ThemHoaDonChiTiet']);
        Route::get('/xoa-san-pham-hdct', [QLHoaDonController::class, 'XoaHoaDonChiTiet']);
        /////////////
        Route::get('/tao-hoa-don', [QLHoaDonController::class, 'TrangTaoHoaDon']);
        Route::post('/tao-hoa-don', [QLHoaDonController::class, 'TaoHoaDon']);
        //////////////
        // Route::post('/them-hoa-don', [QLHoaDonController::class, 'ThemHoaDon']); khong xoa
        Route::post('/cap-nhat-trang-thai-don-hang', [QLHoaDonController::class, 'CapNhatTTDonHang']);
        Route::post('/cap-nhat-trang-thai-thanh-toan', [QLHoaDonController::class, 'CapNhatTTTT']);
      });

      // QL mã giảm giá
      Route::get('/magiamgia', [MaGiamGiaController::class, 'index']);
      Route::get('/magiamgia/lay-ma-giam-gia', [MaGiamGiaController::class, 'lay_ma_giam_gia']);
      Route::post('/magiamgia/them-ma-giam-gia', [MaGiamGiaController::class, 'them_ma_giam_gia']);
      Route::post('/magiamgia/cap-nhat-ma-giam-gia', [MaGiamGiaController::class, 'cap_nhat_ma_giam_gia']);
      Route::post('/magiamgia/xoa-ma', [MaGiamGiaController::class, 'xoa_ma_giam_gia']);
    });

    // nhan vien dang bai (sale) - qlsp-lh-kh-bv
    Route::middleware(['NhanVienDangBaiMiddleware'])->group(function () {

      //bài viết --------------
      Route::get('/baiviet', [BaivietController::class, 'baiviet']);
      Route::post('/baiviet', [BaivietController::class, 'taobaiviet']);
      Route::get('/baiviet/{id}', [BaivietController::class, 'xoa_baiviet']);
      Route::post('/capnhat_baiviet/{id}', [BaivietController::class, 'capnhat_baiviet']);
      Route::get('/baiviet/doitrangthai', [BaivietController::class, 'doitrangthai']);
      Route::post('/baiviet/khoiphuc', [BaivietController::class, 'restore']);

      // QL banner
      Route::get('/banner', [QLbannerController::class, 'index']);
      Route::post('/banner', [QLbannerController::class, 'them_banner']);
      Route::post('/banner/capnhat/{id}', [QLbannerController::class, 'capnhat_banner']);
      Route::get('/banner/xoa/{id}', [QLbannerController::class, 'xoa_banner']);
    });

    // quan ly nhan vien
    Route::middleware(['QuanLyMiddleware'])->group(function () {

      // thong ke --------------
      // Route::group(['prefix' => '/thong-ke'], function () {
      //   Route::get('/', [ThongKeController::class, 'index']);
      //   Route::get('/du-lieu', [ThongKeController::class, 'DuLieuThongKe']);
      // });

      //danhmuc --------------
      Route::group(['prefix' => '/danhmuc'], function () {
        Route::get('/', [DanhmucController::class, 'index']);
        Route::get('/du-lieu', [DanhmucController::class, 'HienThiDanhMuc']); // url/admin/danh-muc/du-lieu
        Route::post('/', [DanhmucController::class, 'ThemDanhMuc']);
        Route::post('/xoa', [DanhmucController::class, 'XoaDanhMuc']);
        Route::post('/cap-nhat', [DanhmucController::class, 'CapNhatDanhMuc']);

        // trash

        Route::post('/phuc-hoi', [DanhmucController::class, 'PhucHoiDanhMuc']);
        Route::post('/phuc-hoi-all', [DanhmucController::class, 'PhucHoiTatCaDanhMuc']);
        Route::post('/xoa-cung', [DanhmucController::class, 'XoaDanhMucVinhVien']);
      });

      //the loai --------------
      Route::group(['prefix' => '/theloai'], function () {
        Route::get('/', [LoaiSanphamController::class, 'index']);
        Route::get('/du-lieu', [LoaiSanphamController::class, 'HienThiTheLoai']); // url/admin/the-loa/du-lieu
        Route::post('/', [LoaiSanphamController::class, 'ThemTheLoai']);
        Route::post('/xoa', [LoaiSanphamController::class, 'XoaTheLoai']);
        Route::post('/cap-nhat', [LoaiSanphamController::class, 'CapNhatTheLoai']);

        // trash

        Route::post('/phuc-hoi', [LoaiSanphamController::class, 'PhucHoiTheLoai']);
        Route::post('/phuc-hoi-all', [LoaiSanphamController::class, 'PhucHoiTatCaTheLoai']);
        Route::post('/xoa-cung', [LoaiSanphamController::class, 'XoaTheLoaiVinhVien']);
      });


      // Quan Ly Nhân viên --------------
      Route::group(['prefix' => '/quan-ly-nhan-vien'], function () {
        Route::get('/', [QLNhanVienController::class, 'QuanLyNhanVien']);
        Route::get('/du-lieu', [QLNhanVienController::class, 'DuLieuNhanVien']);
        Route::post('/them-nhan-vien', [QLNhanVienController::class, 'ThemNhanVien']);
        Route::post('/xoa-nhan-vien', [QLNhanVienController::class, 'XoaNhanVien']);
        Route::post('/cap-nhat-nhan-vien', [QLNhanVienController::class, 'CapNhatNhanVien']);
      });
    });

    // thong ke --------------
    Route::get('/', [ThongKeController::class, 'index']);
    Route::get('/du-lieu', [ThongKeController::class, 'DuLieuThongKe']);
    Route::post('/du-lieu', [ThongKeController::class, 'CapNhatNgay']);

    // Lien He --------------
    Route::group(['prefix' => '/lien-he'], function () {
      Route::get('/', [LienHeController::class, 'QuanLyLienHe']);
      Route::get('/du-lieu', [LienHeController::class, 'LayDuLieu']);
      Route::post('/xoa-lien-he', [LienHeController::class, 'XoaLienHe']);
      Route::post('/xem-lien-he', [LienHeController::class, 'XemLienHe']);
      Route::post('/xem-lien-he-header', [LienHeController::class, 'XemLienHeHeader']);
    });

    // Quan Ly Tai Khoan --------------
    Route::group(['prefix' => '/quan-ly-tai-khoan'], function () {
      Route::get('/', [QLTaiKhoanController::class, 'QuanLyTaiKhoan']);
      Route::get('/du-lieu', [QLTaiKhoanController::class, 'DuLieuTaiKhoan']);
      Route::post('/them-tai-khoan', [QLTaiKhoanController::class, 'ThemTaiKhoan']);
      Route::post('/xoa-tai-khoan', [QLTaiKhoanController::class, 'XoaTaiKhoan']);
      Route::post('/cap-nhat-tai-khoan', [QLTaiKhoanController::class, 'CapNhatTaiKhoan']);
    });

    //sanpham --------------
    Route::get('/sanpham', [SanphamController::class, 'sanpham']);
    Route::post('/sanpham', [SanphamController::class, 'them_sanpham']);
    Route::get('/xoasanpham', [SanphamController::class, 'xoa_sanpham']);
    Route::post('/capnhatsanpham/{id}', [SanphamController::class, 'cn_sanpham_']);
    Route::get('/toggleStatus', [SanphamController::class, 'toggleStatus']);
    // trash
    Route::get('/sanpham/phuc-hoi', [SanphamController::class, 'PhucHoiSanPham']);
    Route::get('/sanpham/phuc-hoi-all', [SanphamController::class, 'PhucHoiTatCaSanPham']);
    Route::get('/sanpham/xoa-cung', [SanphamController::class, 'XoaSanPhamVinhVien']);

    // Hình Ảnh --------------
    Route::get('/xoahinhanh', [hinhanhController::class, 'xoa_hinhanh']);

    // QL bình luận
    Route::get('/binhluan', [QLBinhluanController::class, 'index']);
    Route::get('/lay-binh-luan-san-pham', [QLBinhluanController::class, 'binhluan_sanpham']);
    Route::get('xoa-binh-luan-bai-viet/{id}', [QLBinhluanController::class, 'xoa_binh_luan_baiviet']);
    Route::get('xoa-binh-luan-san-pham/{id}', [QLBinhluanController::class, 'xoa_binh_luan_sanpham']);


    Route::get('/ho-so', [TaiKhoanController::class, 'HoSo']);
    Route::get('/ho-so/du-lieu', [TaiKhoanController::class, 'DuLieuHoSo']);
    Route::post('/ho-so/cap-nhat', [TaiKhoanController::class, 'CapNhatHoSo']);
    Route::get('/ho-so/cap-nhat-mat-khau', [TaiKhoanController::class, 'DoiMatKhau']);
    Route::post('/ho-so/cap-nhat-mat-khau', [TaiKhoanController::class, 'DoiMatKhauHoSo']);
  });

  Route::get('/dang-nhap', [TaiKhoanController::class, 'DangNhap']);
  Route::post('/kich-hoat-dang-nhap', [TaiKhoanController::class, 'KichHoatDangNhap']);
  Route::get('/dang-xuat', [TaiKhoanController::class, 'DangXuat']);
  // QUÊN MẠT KHẨU
  Route::get('/ho-so/quen-mat-khau', [TaiKhoanController::class, 'QuenMatKhau']);
  Route::post('/ho-so/quen-mat-khau', [TaiKhoanController::class, 'QuenMatKhauHoSo']);
  Route::get('/ho-so/kich-hoat-mail-doi-mat-khau/{ma_bam_quen_mat_khau}', [TaiKhoanController::class, 'KichHoatMailDoiMatKhau']);
  Route::post('/ho-so/doi-mat-khau', [TaiKhoanController::class, 'KichHoatDoiMatKhau']);
});





// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//   \vendor\UniSharp\LaravelFilemanager\Lfm::routes();
// });

Route::get('/', [TrangChuController::class, 'TrangChu']);
// ĐĂNG NHẬP
Route::get('/dang-nhap', [KhachHangController::class, 'DangNhap']);
Route::post('/kich-hoat-dang-nhap', [KhachHangController::class, 'KichHoatDangNhap']);
// ĐĂNG KÝ
Route::get('/dang-ky', [KhachHangController::class, 'DangKy']);
Route::post('/kich-hoat-dang-ky', [KhachHangController::class, 'KichHoatDangKy']);
Route::get('/kich-hoat-mail-tai-khoang/{ma_bam}', [KhachHangController::class, 'KichHoatMailTaiKhoang']);
// QUÊN MẠT KHẨU
Route::get('/quen-mat-khau', [KhachHangController::class, 'QuenMatKhau']);
Route::post('/kich-hoat-quen-mat-khau', [KhachHangController::class, 'KichHoatQuenMatKhau']);
Route::get('/kich-hoat-mail-doi-mat-khau/{ma_bam_quen_mat_khau}', [KhachHangController::class, 'KichHoatMailDoiMatKhau']);
Route::post('/doi-mat-khau', [KhachHangController::class, 'KichHoatDoiMatKhau']);
//HỒ SƠ, ĐĂNG XUẤT, ĐỔI MẬT KHẨU 

// Route::get('/lien-he', [LienHeController::class, 'LienHe']);

Route::get('/dang-xuat', [KhachHangController::class, 'DangXuat']);

Route::group(['prefix' => '/khach-hang', 'middleware' => 'KhachHangDangNhap'], function () {
  Route::get('/ho-so', [KhachHangController::class, 'HoSo']);
  Route::get('/thong-tin-khach-hang', [KhachHangController::class, 'ThongTinKhachHang']);
  Route::post('/kich-hoat-cap-nhap-thong-tin', [KhachHangController::class, 'KichHoatCapNhapThongTin']);
  Route::get('/cap-nhap-mat-khau', [KhachHangController::class, 'CapNhapMatKhau']);
  Route::post('/kich-hoat-cap-nhap-mat-khau', [KhachHangController::class, 'KichHoatCapNhapMatKhau']);


  // giỏ hàng 
  Route::get('/hien-thi-ds-gio-hang', [GioHangController::class, 'HienThiDsGioHang']);
  Route::post('/them-so-luong/{id}', [GioHangController::class, 'ThemSoLuong']);
  Route::post('/tru-so-luong/{id}', [GioHangController::class, 'TruSoLuong']);
  Route::post('/xoa-san-pham-gio-hang/{id}', [GioHangController::class, 'XoaSanPhamGioHang']);
  Route::post('/mua-hang-ngay/{id}', [GioHangController::class, 'MuaHangNgay']);


  // sản phẩm yêu thích
  Route::post('/quan-ly-san-pham-yeu-thich/{id}', [SanPhamYeuThichController::class, 'QuanLySanPhamYeuThich']);

  // mã giảm giá


  // thanh toán
  Route::post('/thanh-toan', [ThanhToanControllerr::class, 'ThanhToan']);
  Route::get('/thanh-toan-thanh-cong', [ThanhToanControllerr::class, 'ThanhToanThanhCong']);
  Route::get('/lich-su-mua-hang', [ThanhToanControllerr::class, 'LichSuMuaHang']);
  Route::get('/ds-lich-su-mua-hang', [ThanhToanControllerr::class, 'DsLichSuMuaHang']);
  Route::post('/huy-don/{id}', [ThanhToanControllerr::class, 'HuyDon']);
});

Route::post('/ma-giam-gia/{ma_giam_gia}', [GioHangController::class, 'MaGiamGia']);
// Route::get('/tai-ma-giam-gia', [GioHangController::class, 'TaiMaGiamGia']);
Route::get('/hien-thi-san-pham-yeu-thich', [SanPhamYeuThichController::class, 'HienThiSanPhamYeuThich']);
Route::get('/san-pham-yeu-thich', [SanPhamYeuThichController::class, 'SanPhamYeuThich']);
//Liên hệ
Route::get('/lien-he', [LienHeController::class, 'LienHe']);
Route::post('/gui-lien-he', [LienHeController::class, 'GuiLienHe']);


//


Route::get('/san-pham', [TrangChuController::class, 'SanPhamTatCa']);
Route::get('/san-pham/{ten_danh_muc_slug}', [TrangChuController::class, 'SanPhamDanhMuc']);
Route::get('/san-pham/{ten_danh_muc_slug}/{ten_loai_slug}', [TrangChuController::class, 'SanPhamTheLoai']);
Route::get('/san-pham/{ten_danh_muc_slug}/{ten_loai_slug}/{ten_san_pham_slug}/{id}', [TrangChuController::class, 'SanPhamChiTiet']);

Route::get('/san-pham-nam', [TrangChuController::class, 'SanPhamNam']);
Route::get('/san-pham-nu', [TrangChuController::class, 'SanPhamNu']);
Route::get('/san-pham-tre-em', [TrangChuController::class, 'SanPhamTreEm']);
Route::get('/gio-hang', [TrangChuController::class, 'GioHang']);
Route::get('/thanh-toan', [TrangChuController::class, 'ThanhToan']);
Route::get('/gioi-thieu', [TrangChuController::class, 'GioiThieu']);
Route::get('/tin-tuc', [TinTucController::class, 'TinTuc']);
Route::get('/tin-tuc/{id}', [TinTucController::class, 'TinTuc_theoloai']);
Route::get('/tin-tuc-chi-tiet/{id}', [TinTucController::class, 'TinTucChiTiet']);
// binh luan tin tuc
Route::get('/binh-luan-tin-tuc', [BinhluanTintucController::class, 'binhluan_baiviet']);
Route::post('/them-binhluan-tintuc', [BinhluanTintucController::class, 'them_binhluan']);
// binh luan san pham
Route::get('/lay-binh-luan-san-pham', [BinhluanController::class, 'binhluan_sanpham']);
Route::post('/them-binh-luan-san-pham', [BinhluanController::class, 'them_binhluan']);


Route::get('/tim-kiem', [TrangChuController::class, 'TimKiemPost']);
Route::post('/tim-kiem-nang-cao', [TrangChuController::class, 'TimKiemNangcao']);
// 
Route::post('/loc-san-pham', [TrangChuController::class, 'locSanPham']);


Route::group(['prefix' => 'laravel-filemanager'], function () {
  \UniSharp\LaravelFilemanager\Lfm::routes();
});
