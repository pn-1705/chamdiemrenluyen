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
        $maLop = $request -> lopID;

        $listClass = DB::table('lop')->where('maKhoa', $khoaID)->get();
        $listStudent1 = DB::table('sinhvien')
            ->join('lop', 'sinhvien.lopID', '=', 'lop.maLop')
            ->where('maSV', 'like', '%' . $id . '%')
            ->orWhere('tenSV', 'like', '%' . $id . '%')
            ->get();
        if ($maLop != null){
            $listStudent = $listStudent1->where('maLop', '=', $maLop);
        } else{
            $listStudent = $listStudent1;
        }
        //dd($listStudent);

        $dt['listStudent'] = $listStudent;
        $dt['listClass'] = $listClass;
        $dt['id'] = $id;
        $dt['lopID'] = $maLop;
        return view('admin.pages.khoa.index', $dt);
    }

    public function lop(Request $request)
    {
        $khoaID = Session('khoaID');

        $id = $request->student;
        $listClass = DB::table('lop')
            ->leftjoin('giaovien', 'gvcn', '=', 'maGV')
            ->where('maKhoa', $khoaID)->get();
        $listStudent = DB::table('sinhvien')
            ->join('lop', 'sinhvien.lopID', '=', 'lop.maLop')
            ->where('maSV', 'like', '%' . $id . '%')
            ->orWhere('tenSV', 'like', '%' . $id . '%')
            ->get();

        $dt['listStudent'] = $listStudent;
        $dt['listClass'] = $listClass;
        $dt['id'] = $id;
        return view('admin.pages.khoa.listclass', $dt);
    }

    public function giaovien(Request $request)
    {
        $khoaID = Session('khoaID');

        $id = $request->student;
        $listGV = DB::table('giaovien')
            ->join('nguoidung', 'nguoidung.maND', '=', 'giaovien.maND')
            ->where('khoaID', $khoaID)->get();

        $dt['listGV'] = $listGV;
        $dt['id'] = $id;
        return view('admin.pages.khoa.teacher', $dt);
    }

    public function addgiaovien()
    {
        return view('admin.pages.khoa.addTeacher');
    }

    public function postgiaovien(Request $request)
    {
        $khoaID = Session('khoaID');
//        dd($khoaID);
        $check = DB::table('nguoidung')->where('maND', '=', $request->maGV)->first();

        if ($request->maGV == null ||
            $request->ten == null ||
            $request->sdt == null ||
            $request->email == null ||
            $request->diachi == null ||
            $request->hocham == null ||
            $request->namsinh == null ||
            $request->matkhau == null) {
            return redirect()->back()->with('thieutruong', 'Vui lòng điền đủ thông tin !');
        }
        if ($check != null) {
            return redirect()->back()->with('tontai', 'Đã tồn tại tài khoản !');
        }
        DB::table('nguoidung')->insert([
            'maND' => $request->maGV,
            'matkhau' => $request->matkhau,
            'role' => 2
        ]);

        DB::table('giaovien')->insert([
            'maGV' => $request->maGV,
            'maND' => $request->maGV,
            'ten' => $request->ten,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'diachi' => $request->diachi,
            'hocham' => $request->hocham,
            'namsinh' => $request->namsinh,
            'khoaID' => $khoaID
        ]);

        $listGV = DB::table('giaovien')
            ->join('nguoidung', 'nguoidung.maND', '=', 'giaovien.maND')
            ->where('khoaID', $khoaID)->get();
        $dt['listGV'] = $listGV;

        return redirect()->route("chamdiemrenluyen.giaovien")->with('add', 'Đã thêm 1 tài khoản !');
    }

    public function del($id)
    {
        DB::table('nguoidung')->where('maND', '=', $id)->delete();
        DB::table('giaovien')->where('maGV', '=', $id)->delete();
        return redirect()->back()->with('del', 'Đã xóa 1 tài khoản !');
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
