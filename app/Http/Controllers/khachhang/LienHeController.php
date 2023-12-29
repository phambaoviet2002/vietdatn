<?php


namespace App\Http\Controllers\khachhang;

use App\Http\Controllers\Controller;
use App\Http\Requests\LienHe;
use App\Jobs\GuiMailLienHe;
use App\Models\LienheModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LienHeController extends Controller
{
    public function LienHe()
    {
        return view('Trang-Khach-Hang.page.LienHe');
    }





public function GuiLienHe(LienHe $request)
{
    // Kiểm tra xem người dùng đã đăng nhập chưa
    if (Auth::check()) {
        $du_lieu = $request->all();
        dd($du_lieu);
        $user = Auth::guard('khach_hang')->user();
        // Nếu không, tiếp tục tạo mới bản ghi
        LienheModel::create($du_lieu);

        // Phân cụm này qua JOB
        $du_lieu_Mail['ho_va_ten'] = $user->ho_va_ten;
        $du_lieu_Mail['email']     = $user->email;
        $du_lieu_Mail['tieu_de']   = $request->tieu_de;
        $du_lieu_Mail['noi_dung']  = $request->noi_dung;

        GuiMailLienHe::dispatch($du_lieu_Mail);

        return response()->json([
            'status'  => true,
            'message' => 'Đã gửi liên hệ, chúng tôi sẽ phản hồi sớm!'
        ]);
    } else {
        $du_lieu = $request->all();
        // Nếu không, tiếp tục tạo mới bản ghi
        LienheModel::create($du_lieu);
        // Phân cụm này qua JOB
        $du_lieu_Mail['ho_va_ten'] = $request->ho_va_ten;
        $du_lieu_Mail['email']     = $request->email;
        $du_lieu_Mail['tieu_de']   = $request->tieu_de;
        $du_lieu_Mail['noi_dung']  = $request->noi_dung;

        GuiMailLienHe::dispatch($du_lieu_Mail);

        return response()->json([
            'status'  => true,
            'message' => 'Đã gửi liên hệ, chúng tôi sẽ phản hồi sớm!'
        ]);
    }
}


 
    public function QuanLyLienHe()
    {
        return view('AdminRocker.page.LienHe');
    }

    public function LayDuLieu()
    {
        $du_lieu = LienheModel::all();

        return response()->json(['du_lieu' => $du_lieu]);
    }

    public function XoaLienHe(Request $request)
    {
        LienheModel::find($request->id)->delete();

        return response()->json([
            'status'    =>      true,
            'message'   =>      'Đã xóa liên hệ thành công !'
        ]);

    }

    public function XemLienHe(Request $request) {

        LienheModel::where('id', $request->id)->update(
            [
                'xu_ly' => 1
            ]
        );
    }

    public function XemLienHeHeader() {
        $id = $_GET['id_data'];
        LienheModel::where('id', $id)->update(
            [
                'xu_ly' => 1
            ]
        );
    }
}
