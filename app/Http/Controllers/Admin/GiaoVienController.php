<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function redirect;
use function view;

class GiaoVienController extends Controller
{
    public function showStudent()
    {
        //Lấy id lớp
        $lopID = Session('lopID');
        $listStudent = DB::table('sinhvien')->where('lopID', '=', $lopID)
            ->orderBy('sinhvien.maSV')
            ->get();
        return view('admin.pages.product.index', ['listStudent' => $listStudent]);
    }

    public function viewScore()
    {
        //Lấy id lớp
        $checkRole = Session('Quyen_id');

        if ($checkRole == 2){
            $hockiMax = DB::table('hocki')->orderBy('id', 'desc')->first();
            //dd($hockiMax -> id);
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
            $lopID = Session('lopID');
            $listScore = DB::table('sinhvien')

                ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
                ->where('lopID', '=', $lopID)
                ->where('hockiID', '=', $hockiMax->id)
                ->get();
            $data['listScore'] = $listScore;
            $data['listHocKi'] = $listHocKi;
        }else{
            $hockiMax = DB::table('hocki')->orderBy('id', 'desc')->first();
            //dd($hockiMax -> id);
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
            $lopID = Session('lopID');
            $listScore = DB::table('sinhvien')

                ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
                ->where('hockiID', '=', $hockiMax->id)
                ->get();
            $data['listScore'] = $listScore;
            $data['listHocKi'] = $listHocKi;
        }



//        dd($data);
        return view('admin.pages.product.viewScore', $data);
    }

    public function viewScoreHocKi(Request $request)
    {
        //dd($hockiMax -> id);
        $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
        $lopID = Session('lopID');
        $listScore = DB::table('sinhvien')
            ->where('lopID', '=', $lopID)
            ->where('hockiID', '=', $request->hockiID)
            ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
            ->get();
        //dd($listScore);
        $data['listScore'] = $listScore;
        $data['listHocKi'] = $listHocKi;
        Session::put('hk', $request->hockiID);
//        dd($data);
        return view('admin.pages.product.viewScore', $data);
    }

    public function duyetDRL($maSV, Request $request)
    {
        $diemTDG = DB::table('bangdiem')
            ->where('maSV', '=', $maSV)
            ->get('diemTDG');
        //$diemTDG = Session('diemTDG');

        //dd(value($diemTDG[0]));
        foreach ($diemTDG as $value) {
            //GV duyệt ĐRL
            DB::table('bangdiem')
                ->where('maSV', '=', $maSV)
                ->update([
                    'diemLDG' => $value->diemTDG
                ]);
        }

        $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
        $lopID = Session('lopID');
        $listScore = DB::table('sinhvien')
            ->where('lopID', '=', $lopID)
            ->where('hockiID', '=', $request->hockiID)
            ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
            ->get();
        //dd($listScore);
        $data['listScore'] = $listScore;
        $data['listHocKi'] = $listHocKi;
        Session::put('hk', $request->hockiID);
        return redirect()->back()->with($data)->with('duyet', 'Đã duyệt điểm rèn luyện cho SV: ' . $maSV);
    }

    public function khoaduyetDRL($maSV)
    {
        $diemTDG = DB::table('bangdiem')
            ->where('maSV', '=', $maSV)
            ->get('diemLDG');
        //$diemTDG = Session('diemTDG');

        //dd(value($diemTDG[0]));
        foreach ($diemTDG as $value) {
            //GV duyệt ĐRL
            DB::table('bangdiem')
                ->where('maSV', '=', $maSV)
                ->update([
                    'diemKDG' => $value->diemLDG
                ]);
        }
        return redirect()->back()->with('duyet', 'Đã duyệt điểm rèn luyện cho SV: ' . $maSV);
    }
//
//    public function addProduct()
//    {
//        $cate = DB::table('danhmuc')->get();
//        $br = DB::table('loaisanpham')->get();
//        $km = DB::table('khuyenmai')->get();
//        $data['cate'] = $cate;
//        $data['br'] = $br;
//        $data['km'] = $km;
//        return view('admin.pages.product.add', $data);
//    }
//
//    public function addProductPost(Request $request)
//    {
//        $data = $request->all();
//        $new = new Product();
//        $new->TH_id = $request->TH_id;
//        $new->DM_id = $request->DM_id;
//        $new->MoTa = $request->MoTa;
//        $new->TenSP = $request->TenSP;
//        $new->DonGia = $request->DonGia;
//        $new->SoLuong = $request->SoLuong;
//        $new->HinhAnh1 = 'img/products/'.$request->HinhAnh1;
//        $new->HinhAnh2 = 'img/products/'.$request->HinhAnh2;
//        $new->HinhAnh3 = 'img/products/'.$request->HinhAnh3;
//        $new->KM_id = $request->KM_id;
//        $new->TrangThai = $request->TrangThai;
//        $new->save();
//        return redirect()->route("admin.product.index")->with('add', 'Data inserted thành công');
//    }
//
//    public function edit($id)
//    {
//        $product = Product::find($id);
//        $cate = DB::table('danhmuc')->get();
//        $br = DB::table('loaisanpham')->get();
//        $km = DB::table('khuyenmai')->get();
//        $data['product'] = $product;
//        $data['cate'] = $cate;
//        $data['br'] = $br;
//        $data['km'] = $km;
//        return view('admin.pages.product.edit', $data);
//    }
//
//    public function update($id, Request $request)
//    {
//        $new = Product::find($id);
//        $new->TH_id = $request->TH_id;
//        $new->DM_id = $request->DM_id;
//        $new->MoTa = $request->MoTa;
//        $new->TenSP = $request->TenSP;
//        $new->DonGia = $request->DonGia;
//        $new->SoLuong = $request->SoLuong;
//        $new->HinhAnh1 = $request->HinhAnh1;
//        $new->HinhAnh2 = $request->HinhAnh2;
//        $new->HinhAnh3 = $request->HinhAnh3;
//        $new->KM_id = $request->KM_id;
//        $new->TrangThai = $request->TrangThai;
//        $new->save();
//        return redirect()->route("admin.product.index")->with('updated', 'Data updated thành công');
//    }
//
//    public function destroy($id)
//    {
//        DB::table('sanpham')->where('id', $id)->delete();
//        return redirect()->route("admin.product.index")->with('del', 'Data deleted thành công');
//    }
////    public function cate_product($id)
////    {
////        $list = DB::table('sanpham')
////            ->join('danhmuc', 'sanpham.DM_id', '=', 'danhmuc.id')
////            ->join('loaisanpham', 'sanpham.TH_id', '=', 'loaisanpham.id')
////            ->join('khuyenmai', 'sanpham.KM_id', '=', 'khuyenmai.id')
////            ->where('DM_id', $id)
////            ->select('sanpham.*', 'danhmuc.TenDM', 'loaisanpham.TenLSP', 'khuyenmai.TenKM')
////            ->orderBy('danhmuc.id')
////            ->get();
////        $list_cate = Category::get();
////        $data['list_cate'] = $list_cate;
////        return view('admin.pages.product.index', ['list_product' => $list], $data);
////    }
//
//    public function active($id)
//    {
//        $pr = Product::find($id);
//        $product = Product::find($id);
////        dd($pr);
//        if ($pr->TrangThai == 1) {
//            $product->TrangThai = 0;
//        } else {
//            $product->TrangThai = 1;
//        }
//        $product->save();
//        return redirect()->back()->with('active', 'Đã chuyển trạng thái SP' . $id);
//
//    }
}
