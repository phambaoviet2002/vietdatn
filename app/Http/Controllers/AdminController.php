<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view('AdminRocker.page.SanPham.index');
    }
}
