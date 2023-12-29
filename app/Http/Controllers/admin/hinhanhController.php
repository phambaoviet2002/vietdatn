<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HinhanhModel;
use Illuminate\Http\Request;
use App\Models\SanphamModel;
use App\Models\LoaisanphamModel;


class hinhanhController extends Controller
{
    public function xoa_hinhanh()
    {
        $id = $_GET['idImg'];
        $xoa = HinhanhModel::find($id);
        if ($xoa == null) {
            echo '<script type ="text/JavaScript">alert("loi roi!");</script>';
        } else {
            $xoa->delete();
            // return response()->json([
            //     'success' => 'Record deleted successfully!'
            // ]);
        }
    }
}