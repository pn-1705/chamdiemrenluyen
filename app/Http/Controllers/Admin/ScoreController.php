<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use function redirect;
use function Symfony\Component\String\s;
use function view;

class ScoreController extends Controller
{
    public function index()
    {
        $hocki = DB::table('hocki')->orderBy('tgKT', 'desc')->get();
        $maSV = Session('maND');
        $diemTDG = DB::table('diemsvtudanhgia')->where('maSV', '=', $maSV)->first();
        //dd($diemTDG);
//        $ndDGDRL = DB::table('noidungdanhgiadrl')->get();
        $data['hocki'] = $hocki;
        $data['diemTDG'] = $diemTDG;
        return view('admin.pages.category.index', $data);
    }

    public function updateScore($id, Request $request)
    {
        //data view
        $diemTDG = DB::table('diemsvtudanhgia')->where('maSV', '=', $id)->first();
        $list_hocki = DB::table('hocki')->orderBy('tgKT', 'desc')->get();
        $data['hocki'] = $list_hocki;
        $data['diemTDG'] = $diemTDG;


        $tgSV = DB::table('hocki')
            ->where('id', '=', $request->hockiID)
            ->first()->tgSVBD;

        $tgTTL = DB::table('hocki')
            ->where('id', '=', $request->hockiID)
            ->first()->tgTTLBD;
//        dd(date('Y-m-d', strtotime($tgTTL)));
        if (date('Y-m-d') >= date('Y-m-d', strtotime($tgTTL))) {
                return redirect()->back()->with('overtime', 'Thời gian sinh viên chấm ĐRL đã kết thúc vào ngày: ' . $tgTTL);
        }
        if (date('Y-m-d') < date('Y-m-d', strtotime($tgSV))) {
            return redirect()->back()->with('nottime', 'Chưa đến thời gian sinh viên chấm ĐRL. Thời gian bắt đầu: ' . $tgSV);
        }


        $check = DB::table('diemsvtudanhgia')->where('maSV', '=', $id)->first();
        $checkBangDiem = DB::table('bangdiem')->where('maSV', '=', $id)->first();
        if ($check) {
            DB::table('diemsvtudanhgia')
                ->where('maSV', '=', $id)
                ->where('hockiID', '=', $request->hockiID)
                ->update([
                    'muc1' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16,
                    'muc2' => $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24,
                    'muc3' => $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34,
                    'muc4' => $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45,
                    'muc5' => $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54,
                    'muc11' => $request->muc11,
                    'muc12' => $request->muc12,
                    'muc13' => $request->muc13,
                    'muc14' => $request->muc14,
                    'muc15' => $request->muc15,
                    'muc16' => $request->muc16,
                    'muc21' => $request->muc21,
                    'muc22' => $request->muc22,
                    'muc23' => $request->muc23,
                    'muc24' => $request->muc24,
                    'muc31' => $request->muc31,
                    'muc32' => $request->muc32,
                    'muc33' => $request->muc33,
                    'muc34' => $request->muc34,
                    'muc41' => $request->muc41,
                    'muc42' => $request->muc42,
                    'muc43' => $request->muc43,
                    'muc44' => $request->muc44,
                    'muc45' => $request->muc45,
                    'muc51' => $request->muc51,
                    'muc52' => $request->muc52,
                    'muc53' => $request->muc53,
                    'muc54' => $request->muc54,
                    'muc6' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16
                        + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                        + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                        + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                        + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54
                ]);
            if ($checkBangDiem) {
                DB::table('bangdiem')
                    ->where('maSV', '=', $id)
                    ->where('hockiID', '=', $request->hockiID)
                    ->update([
                        'diemTDG' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16
                            + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                            + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                            + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                            + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54
                    ]);
            } else {
                DB::table('bangdiem')
                    ->insert([
                        'maSV' => $id,
                        'hockiID' => $request->hockiID,
                        'diemTDG' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16
                            + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                            + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                            + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                            + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54
                    ]);
            }

        } else {
            DB::table('diemsvtudanhgia')
                ->insert([
                    'maSV' => $id,
                    'hockiID' => $request->hockiID,
                    'muc1' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16,
                    'muc2' => $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24,
                    'muc3' => $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34,
                    'muc4' => $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45,
                    'muc5' => $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54,
                    'muc11' => $request->muc11,
                    'muc12' => $request->muc12,
                    'muc13' => $request->muc13,
                    'muc14' => $request->muc14,
                    'muc15' => $request->muc15,
                    'muc16' => $request->muc16,
                    'muc21' => $request->muc21,
                    'muc22' => $request->muc22,
                    'muc23' => $request->muc23,
                    'muc24' => $request->muc24,
                    'muc31' => $request->muc31,
                    'muc32' => $request->muc32,
                    'muc33' => $request->muc33,
                    'muc34' => $request->muc34,
                    'muc41' => $request->muc41,
                    'muc42' => $request->muc42,
                    'muc43' => $request->muc43,
                    'muc44' => $request->muc44,
                    'muc45' => $request->muc45,
                    'muc51' => $request->muc51,
                    'muc52' => $request->muc52,
                    'muc53' => $request->muc53,
                    'muc54' => $request->muc54,
                    'muc6' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15
                        + $request->muc16 + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                        + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                        + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                        + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54
                ]);
            if ($checkBangDiem) {
                DB::table('bangdiem')
                    ->where('maSV', '=', $id)
                    ->where('hockiID', '=', $request->hockiID)
                    ->update([
                        'diemTDG' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16
                            + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                            + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                            + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                            + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54
                    ]);
            } else {
                DB::table('bangdiem')
                    ->insert([
                        'maSV' => $id,
                        'hockiID' => $request->hockiID,
                        'diemTDG' => $request->muc11 + $request->muc12 + $request->muc13 + $request->muc14 + $request->muc15 + $request->muc16
                            + $request->muc21 + $request->muc22 + $request->muc23 + $request->muc24
                            + $request->muc31 + $request->muc32 + $request->muc33 + $request->muc34
                            + $request->muc41 + $request->muc42 + $request->muc43 + $request->muc44 + $request->muc45
                            + $request->muc51 + $request->muc52 + $request->muc53 + $request->muc54,
                    ]);
            }
        }
        $tenSV = DB::table('sinhvien')->where('maSV', '=', $id)->first()->tenSV;
        return redirect()->route('chamdiemrenluyen.score', $data)->with('updated', 'Điểm rèn luyện sinh viên '.$tenSV. ' đã cập nhật.');
    }
//
//    public function addCate()
//    {
//        return view('admin.pages.category.add');
//    }
//
//    public function addCatePost(Request $request)
//    {
//        $data = $request->all();
//        $new = new Category();
//        $new->TenDM = $request->TenDM;
//        $new->save();
//        return redirect()->route("admin.category.index")->with('add', 'Data inserted thành công');
//    }
//
//    public function edit($id)
//    {
//        $cate = Category::find($id);
//        $data['cate'] = $cate;
//        return view('admin.pages.category.edit', $data);
//    }
//
//    public function update($id, Request $request)
//    {
//        $new = Category::find($id);
//        $new->TenDM = $request->TenDM;
//        $new->save();
//        return redirect()->route("admin.category.index")->with('updated', 'Data updted thành công');
//    }
//
//    public function destroy($id)
//    {
//        $cate = Category::find($id);
//        $cate->delete();
//        return redirect()->route("admin.category.index")->with('del', 'Data deleted thành công');
//    }
}
