<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;
use function redirect;
use function view;

class StudentController extends Controller
{
    public function index()
    {
        //$list = DB::table('loaisanpham')->get();
        $result = DB::table('sinhvien')->where('maSV', Session('maND'))->first();
        //dd($result);
//        $user = User::find($id);
//        $role = Role::get();
//        $data['user'] = $user;
//        $data['role'] = $role;
        return view('admin.pages.brand.index', ['user' => $result]);
    }

    public function updateProfile($id, Request $request)
    {
        //dd($request->namsinh);
        DB::table('sinhvien')
            ->where('maSV', '=', $id)
            ->update([
                'gioitinh' => $request->gioitinh,
                'quequan' => $request->quequan,
                'sodienthoai' => $request->sdt,
                'namsinh' => $request->namsinh
            ]);

        return redirect()->back()->with('updated', 'Cập nhật thông tin thành công');
    }

    public function changePassword($id, Request $request)
    {
        $oldpassword = DB::table('nguoidung')->where('maND', '=', $id)->first()->matkhau;

        if ($request->newpassword == null || $request->repassword == null) {
            return redirect()->back()->with('error', 'Vui lòng không để trống!');
        } else {

            if ($oldpassword == $request->oldpassword) {
                if ($request->newpassword == $request->repassword) {
                    DB::table('sinhvien')
                        ->where('maSV', '=', $id)
                        ->update([
                            'matkhau' => $request->newpassword
                        ]);
                    DB::table('nguoidung')
                        ->where('maND', '=', $id)
                        ->update([
                            'matkhau' => $request->newpassword
                        ]);

                    return redirect()->back()->with('updatedPassword', 'Đổi mật khẩu thành công!');
                } else {
                    return redirect()->back()->with('error', 'Vui lòng xác nhận lại mật khẩu!');
                }
            } else {
                return redirect()->back()->with('error', 'Mật khẩu cũ không đúng! Vui lòng kiểm tra lại.');
            }
        }

    }
//
//    public function destroy($id)
//    {
//        $br = Brand::find($id);
//        $br->delete();
//        return redirect()->route("admin.brand.index")->with('del', 'Data deleted thành công');
//    }
//
//    public function index_cate()
//    {
//        $cate = DB::table('danhmuc')->get();
//        return view('admin.pages.category.index', ['list_cate' => $cate]);
//    }
}