<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use function back;
use function redirect;
use function view;

class LoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.pages.login');
    }

    public function login(Request $request)
    {
        $maND = $request->maND;
//        $password = md5($request->password);
        $password = $request->password;
        $result = DB::table('nguoidung')->where('maND', $maND)->where('matkhau', $password)->first();

        if ($result) {
            Session::put('maND', $result->maND);
            Session::put('Quyen_id', $result->role);

            if ($result->role == 3) {
                $result = DB::table('nguoidung')
                    ->join('sinhvien', 'nguoidung.maND', '=', 'sinhvien.maND')
                    ->where('sinhvien.maND', $maND)
                    ->first();
                Session::put('ten', $result->tenSV);

                //dd($result);
            } else {
                if ($result->role == 2) {
                    $result = DB::table('nguoidung')
                        ->join('giaovien', 'nguoidung.maND', '=', 'giaovien.maND')
                        ->where('giaovien.maND', $maND)
                        ->first();
                    Session::put('ten', $result->ten);

                    //Session::put('lopID', $result->lopID);
                   // Session::put('khoaID', $result->khoaID);
                    //dd($result->lopID);
                } else {
                    if ($result->role == 1) {
                        $result = DB::table('nguoidung')
                            ->leftJoin('bcnkhoa', 'bcnkhoa.maBCN', '=', 'nguoidung.maND')
                            ->leftjoin('khoa', 'bcnkhoa.maKhoa', '=', 'khoa.maKhoa')
                            ->where('nguoidung.maND', $maND)
                            ->first();
                        Session::put('ten', $result->tenKhoa);
                        Session::put('khoaID', $result->maKhoa);
                        /*$tenKhoa = DB::table('khoa')
                            ->where('maKhoa', '=', $result->khoaID)
                            ->get('tenKhoa')->first()->tenKhoa;
                        Session::put('tenKhoa', $tenKhoa);*/
                    } else {
                        $result = DB::table('nguoidung')
                            ->get()
                            ->first();
                        //Session::put('ten', $result->ten);
                        //Session::put('khoaID', $result->khoaID);
//                        $tenKhoa = DB::table('khoa')
//                            ->where('maKhoa', '=', $result->khoaID)
//                            ->get('tenKhoa')->first()->tenKhoa;
//                        Session::put('tenKhoa', $tenKhoa);
                    }


                }
            }

            return redirect()->intended('home');

        } else {
            Session::put('message', 'Mật khẩu hoặc email không đúng!');
            return back();
        }
    }

    public function logout()
    {
//        Auth::logout();
        Session::flush();
        return Redirect::to('login');
    }
}
