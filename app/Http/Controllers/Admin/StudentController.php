<?php

namespace App\Http\Controllers\Admin;

use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Weidner\Goutte\GoutteFacade;
use function redirect;
use function view;

class StudentController extends Controller
{
    public function index()
    {
        //$list = DB::table('loaisanpham')->get();
        $maND = Session::get('maND');
        $checkRole = DB::table('nguoidung')->where('maND', '=', $maND)->get('role')->first()->role;
        if ($checkRole == 3) {
            $result = DB::table('sinhvien')->where('maSV', Session('maND'))->first();
        } else {
            if ($checkRole == 2) {
                $result = DB::table('giaovien')
                    ->leftJoin('khoa', 'khoaID', '=', 'maKhoa')
                    ->where('maGV', Session('maND'))->first();
            }
        }

//        $user = User::find($id);
//        $role = Role::get();
//        $data['user'] = $user;
//        $data['role'] = $role;
        return view('admin.pages.brand.index', ['user' => $result]);
    }

    public function updateProfile($id, Request $request)
    {
        //dd($request->namsinh);

        $maND = Session::get('maND');
        $checkRole = DB::table('nguoidung')->where('maND', '=', $maND)->get('role')->first()->role;
        if ($checkRole == 3) {
            DB::table('sinhvien')
                ->where('maSV', '=', $id)
                ->update([
                    'gioitinh' => $request->gioitinh,
                    'quequan' => $request->quequan,
                    'sodienthoai' => $request->sdt,
                    'namsinh' => $request->namsinh
                ]);
        } else {
            if ($checkRole == 2) {
                DB::table('giaovien')
                    ->where('maGV', '=', $id)
                    ->update([
                        'gioitinh' => $request->gioitinh,
                        'diachi' => $request->quequan,
                        'sdt' => $request->sdt,
                        'namsinh' => $request->namsinh
                    ]);
            }
        }

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

    public function crawlTKB(Request $request)
    {
        //dd(Session::get('maND'));
        // Lấy mã sinh viên từ request
        $maSinhVien = Session::get('maND');

        // Tạo một đối tượng Goutte Client
        $client = new Client();

        // Gửi yêu cầu POST đến trang web cần crawl với dữ liệu mã sinh viên
        $crawler = $client->request('POST', 'http://daotao.ute.udn.vn/svtkb.asp', [
            'maSV' => $maSinhVien,
        ]);
//        dd($crawler);
        $content = $crawler->filterXPath('//table/tr')->each(function ($node) {
            // Lấy nội dung của từng cột trong mỗi hàng
            $columns = $node->filterXPath('//td')->each(function ($column) {
                return $column->text();
            });

            // Trả về mảng chứa thông tin của thời khóa biểu
            return $columns;
        });
        $hk = $crawler->filter('h4')->each(function ($node) {
            // Lấy nội dung của từng cột trong mỗi hàng
            $columns = $node->filter('')->each(function ($column) {
                return $column->text();
            });

            // Trả về mảng chứa thông tin của thời khóa biểu
            return $columns;
        });

        //dd($content);

        // Trả về dữ liệu thời khóa biểu đã đọc từ file Excel
        return view('admin.pages.brand.TKB', ['tkbData' => $content]);
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
