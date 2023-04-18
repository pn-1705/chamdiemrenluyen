<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function redirect;
use function view;

class KhoaController extends Controller
{
    public function qlsv()
    {
        $khoaID = Session('khoaID');
        //dd($khoaID);
        $listClass = DB::table('lop')->where('maKhoa', $khoaID)->get();
        $listStudent = DB::table('sinhvien')
            ->join('lop', 'sinhvien.lopID', '=', 'lop.maLop')
            ->orderBy('sinhvien.maSV')
            ->get();
        //dd($listClass);

        $dt['listStudent'] = $listStudent;
        $dt['listClass'] = $listClass;
        return view('admin.pages.khoa.index', $dt);
    }

    public function searchStudent(Request $request)
    {
        $khoaID = Session('khoaID');

        $id = $request->student;
        $listClass = DB::table('lop')->where('maKhoa', $khoaID)->get();
        $listStudent = DB::table('sinhvien')
            ->join('lop', 'sinhvien.lopID', '=', 'lop.maLop')
            ->where('maSV', 'like', '%' . $id . '%')
            ->orWhere('tenSV', 'like', '%' . $id . '%')
            ->get();

        $dt['listStudent'] = $listStudent;
        $dt['listClass'] = $listClass;
        $dt['id'] = $id;
        return view('admin.pages.khoa.index', $dt);
    }
//    public function addUser()
//    {
//        $list = Role::get();
//        $dt['quyen'] = $list;
//        return view('admin.pages.user.add', $dt);
//    }
//
//    public function addUserPost(Request $request)
//    {
//        $data = $request->all();
//        $new = new User();
//        $new->Ho = $request->Ho;
//        $new->Ten = $request->Ten;
//        $new->GioiTinh = $request->GioiTinh;
//        $new->SDT = $request->SDT;
//        $new->email = $request->email;
//        $new->DiaChi = $request->DiaChi;
//        $new->username = $request->username;
//        $new->password = $request->password;
//        $new->Quyen_id = $request->Quyen_id;
//        $new->TrangThai = $request->TrangThai;
//        $new->save();
//        return redirect()->route("admin.user.index")->with('add', 'Data inserted thành công');
//    }
//
//    public function edit($id)
//    {
//        $user = User::find($id);
//        $role = Role::get();
//        $data['user'] = $user;
//        $data['role'] = $role;
//        return view('admin.pages.user.edit', $data);
//    }
//
//    public function update($id, Request $request)
//    {
//        $new = User::find($id);
//        $new->Ho = $request->Ho;
//        $new->Ten = $request->Ten;
//        $new->GioiTinh = $request->GioiTinh;
//        $new->SDT = $request->SDT;
//        $new->email = $request->email;
//        $new->DiaChi = $request->DiaChi;
//        $new->username = $request->username;
//        $new->password = $request->password;
//        $new->Quyen_id = $request->Quyen_id;
//        $new->TrangThai = $request->TrangThai;
//        $new->save();
//        return redirect()->route("admin.user.index")->with('updated', 'Data updted thành công');
//    }
//
//    public function destroy($id)
//    {
//        $find = User::find($id);
//        $find->delete();
//        return redirect()->route("admin.user.index")->with('del', 'Data deleted thành công');
//    }
}
