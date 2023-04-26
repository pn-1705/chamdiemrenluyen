<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function view;

session_start();

class HomeController extends Controller
{

    public function home()
    {
//        $banchay = DB::table('sanpham')->orderBy('SoLuong')->take(5)->get();
//        $noibat = DB::table('loaisanpham')->take(5)->get();
//        $data['banchay'] = $banchay;
//        $data['noibat'] = $noibat;
        $ngNhan = Session::get('Quyen_id');

        $listAlert = DB::table('thongbao')->where('nguoinhan', '=', $ngNhan)->get();
//        dd($listAlert);

        return view('admin.pages.dashboard', ['listAlert' => $listAlert]);
    }
    public function contact()
    {
        return view('contact.index');
    }
}

