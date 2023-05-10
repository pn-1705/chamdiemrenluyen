<?php

namespace App\Http\Controllers\Admin;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Goutte\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel;
use PHPUnit\Util\Type;
use function redirect;
use function view;

class GiaoVienController extends Controller
{
    public function showStudent()
    {
        //Lấy id lớp
        $gvcn = Session('maND');
        $listStudent = DB::table('sinhvien')
            ->leftJoin('lop', 'lopID', '=', 'maLop')
            ->where('gvcn', '=', $gvcn)
            ->orderBy('sinhvien.maSV')
            ->get();
        return view('admin.pages.product.index', ['listStudent' => $listStudent]);
    }

    public function viewScore()
    {
        $gv = Session::get('maND');
        $lopID = DB::table('lop')->where('gvcn', '=', $gv)->first();

        //Lấy id lớp
        $checkRole = Session('Quyen_id');

        if ($checkRole == 2) {
            $hockiMax = DB::table('hocki')->orderBy('id', 'desc')->first();
            //dd($hockiMax -> id);
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
            $listScore = DB::table('sinhvien')
                ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
                ->where('lopID', '=', $lopID->maLop)
                ->where('hockiID', '=', $hockiMax->id)
                ->get();
            $data['listScore'] = $listScore;
            $data['listHocKi'] = $listHocKi;
        } else {
            $hockiMax = DB::table('hocki')->orderBy('id', 'desc')->first();
            //dd($hockiMax -> id);
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
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
        $checkRole = Session('Quyen_id');
        if ($checkRole == 2) {
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
            $gvcn = Session('maND');
            $listScore = DB::table('sinhvien')
                ->leftJoin('lop', 'lopID', '=', 'maLop')
                ->where('gvcn', '=', $gvcn)
                ->where('hockiID', '=', $request->hockiID)
                ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
                ->get();
            //dd($listScore);
            $data['listScore'] = $listScore;
            $data['listHocKi'] = $listHocKi;
            Session::put('hk', $request->hockiID);
        } else {
            $listHocKi = DB::table('hocki')->orderBy('id', 'desc')->get();
            $listScore = DB::table('sinhvien')
                ->leftJoin('lop', 'lopID', '=', 'maLop')
                ->where('hockiID', '=', $request->hockiID)
                ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
                ->get();
            //dd($listScore);
            $data['listScore'] = $listScore;
            $data['listHocKi'] = $listHocKi;
            //dd($listScore[0]);
            Session::put('hk', $request->hockiID);
        }

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
        $gvcn = Session('maND');
        $listScore = DB::table('sinhvien')
            ->leftJoin('lop', 'lopID', '=', 'maLop')
            ->where('gvcn', '=', $gvcn)->where('hockiID', '=', $request->hockiID)
            ->leftJoin('bangdiem', 'sinhvien.maSV', '=', 'bangdiem.maSV')
            ->get();
        //dd($listScore);
        $data['listScore'] = $listScore;
        $data['listHocKi'] = $listHocKi;
        Session::put('hk', $request->hockiID);
        return redirect()->back()->with($data)->with('duyet', 'Đã duyệt điểm rèn luyện cho SV: ' . $maSV);
    }

    public function duyetDRLtatca(Request $request)
    {
        $gv = Session::get('maND');
        $lopID = DB::table('lop')->where('gvcn', '=', $gv)->first();

        $array_diemTDG = DB::table('bangdiem')
            ->join('sinhvien', 'sinhvien.maSV', '=', 'bangdiem.maSV')
            ->where('lopID', '=', $lopID->maLop)
            ->get();
        //dd($array_diemTDG);
        //dd(value($diemTDG[0]));
        foreach ($array_diemTDG as $value) {
            //GV duyệt ĐRL
            //dd($value->diemTDG);
            DB::table('bangdiem')->where('maSV', '=', $value->maSV)
                ->update([
                    'diemLDG' => $value->diemTDG
                ]);
        }
        return redirect()->back()->with('duyet', 'Đã duyệt điểm rèn luyện cho các sinh viên hoàn thành !');
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

    public function viewGVcham($maSV, Request $request)
    {
        $infoSV = DB::table('sinhvien')->where('maSV', '=', $maSV)->first();
        $hocki = DB::table('hocki')->orderBy('tgKT', 'desc')->get();
        $diemTDG = DB::table('diemsvtudanhgia')->where('maSV', '=', $maSV)->first();
        $diemLDG = DB::table('diemlopdanhgia')->where('maSV', '=', $maSV)->first();
        //dd($diemTDG);
        $data['hocki'] = $hocki;
        $data['diemTDG'] = $diemTDG;
        $data['diemLDG'] = $diemLDG;
        $data['infoSV'] = $infoSV;

        return view('admin.pages.product.GVchamlai', $data);
    }

    public function updateGVcham($maSV, Request $request)
    {
        $id = $maSV;
        $tgK = DB::table('hocki')
            ->where('id', '=', $request->hockiID)
            ->first()->tgKBD;

        $tgTTL = DB::table('hocki')
            ->where('id', '=', $request->hockiID)
            ->first()->tgTTLBD;
//        dd(date('Y-m-d', strtotime($tgTTL)));
        if (date('Y-m-d') >= date('Y-m-d', strtotime($tgK))) {
            return redirect()->back()->with('overtime', 'Thời gian Giáo viên chấm ĐRL đã kết thúc vào ngày: ' . $tgK);
        }
        if (date('Y-m-d') < date('Y-m-d', strtotime($tgTTL))) {
            return redirect()->back()->with('nottime', 'Chưa đến thời gian Giáo viên chấm ĐRL. Thời gian bắt đầu: ' . $tgTTL);
        }


        $check = DB::table('diemlopdanhgia')->where('maSV', '=', $id)->first();
        $checkBangDiem = DB::table('bangdiem')->where('maSV', '=', $id)->first();
        if ($check) {
            DB::table('diemlopdanhgia')
                ->where('maSV', '=', $id)
                ->where('hockiID', '=', $request->hockiID)
                ->update([
                    'muc1' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16,
                    'muc2' => $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24,
                    'muc3' => $request->lmuc31 + $request->lmuc32 + $request->lmuc33 + $request->lmuc34,
                    'muc4' => $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45,
                    'muc5' => $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54,
                    'muc11' => $request->lmuc11,
                    'muc12' => $request->lmuc12,
                    'muc13' => $request->lmuc13,
                    'muc14' => $request->lmuc14,
                    'muc15' => $request->lmuc15,
                    'muc16' => $request->lmuc16,
                    'muc21' => $request->lmuc21,
                    'muc22' => $request->lmuc22,
                    'muc23' => $request->lmuc23,
                    'muc24' => $request->lmuc24,
                    'muc31' => $request->lmuc31,
                    'muc32' => $request->lmuc32,
                    'muc33' => $request->lmuc33,
                    'muc34' => $request->lmuc34,
                    'muc41' => $request->lmuc41,
                    'muc42' => $request->lmuc42,
                    'muc43' => $request->lmuc43,
                    'muc44' => $request->lmuc44,
                    'muc45' => $request->lmuc45,
                    'muc51' => $request->lmuc51,
                    'muc52' => $request->lmuc52,
                    'muc53' => $request->lmuc53,
                    'muc54' => $request->lmuc54,
                    'muc6' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16 + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                        + $request->lmuc31 + $request->lmuc32 + $request->lmuc33 + $request->lmuc34
                        + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                        + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54
                ]);
            if ($checkBangDiem) {
                DB::table('bangdiem')
                    ->where('maSV', '=', $id)
                    ->where('hockiID', '=', $request->hockiID)
                    ->update([
                        'diemLDG' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16
                            + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                            + $request->lmuc31 + $request->lmuc32 + $request->muc33 + $request->lmuc34
                            + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                            + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54
                    ]);
            } else {
                DB::table('bangdiem')
                    ->insert([
                        'maSV' => $id,
                        'hockiID' => $request->hockiID,
                        'diemLDG' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16
                            + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                            + $request->lmuc31 + $request->lmuc32 + $request->muc33 + $request->lmuc34
                            + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                            + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54
                    ]);
            }

        } else {
            DB::table('diemlopdanhgia')
                ->insert([
                    'maSV' => $id,
                    'hockiID' => $request->hockiID,
                    'muc1' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16,
                    'muc2' => $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24,
                    'muc3' => $request->lmuc31 + $request->lmuc32 + $request->lmuc33 + $request->lmuc34,
                    'muc4' => $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45,
                    'muc5' => $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54,
                    'muc11' => $request->lmuc11,
                    'muc12' => $request->lmuc12,
                    'muc13' => $request->lmuc13,
                    'muc14' => $request->lmuc14,
                    'muc15' => $request->lmuc15,
                    'muc16' => $request->lmuc16,
                    'muc21' => $request->lmuc21,
                    'muc22' => $request->lmuc22,
                    'muc23' => $request->lmuc23,
                    'muc24' => $request->lmuc24,
                    'muc31' => $request->lmuc31,
                    'muc32' => $request->lmuc32,
                    'muc33' => $request->lmuc33,
                    'muc34' => $request->lmuc34,
                    'muc41' => $request->lmuc41,
                    'muc42' => $request->lmuc42,
                    'muc43' => $request->lmuc43,
                    'muc44' => $request->lmuc44,
                    'muc45' => $request->lmuc45,
                    'muc51' => $request->lmuc51,
                    'muc52' => $request->lmuc52,
                    'muc53' => $request->lmuc53,
                    'muc54' => $request->lmuc54,
                    'muc6' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16 + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                        + $request->lmuc31 + $request->lmuc32 + $request->lmuc33 + $request->lmuc34
                        + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                        + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54
                ]);
            if ($checkBangDiem) {
                DB::table('bangdiem')
                    ->where('maSV', '=', $id)
                    ->where('hockiID', '=', $request->hockiID)
                    ->update([
                        'diemLDG' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16
                            + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                            + $request->lmuc31 + $request->lmuc32 + $request->muc33 + $request->lmuc34
                            + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                            + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54
                    ]);
            } else {
                DB::table('bangdiem')
                    ->insert([
                        'maSV' => $id,
                        'hockiID' => $request->hockiID,
                        'diemLDG' => $request->lmuc11 + $request->lmuc12 + $request->lmuc13 + $request->lmuc14 + $request->lmuc15 + $request->lmuc16
                            + $request->lmuc21 + $request->lmuc22 + $request->lmuc23 + $request->lmuc24
                            + $request->lmuc31 + $request->lmuc32 + $request->muc33 + $request->lmuc34
                            + $request->lmuc41 + $request->lmuc42 + $request->lmuc43 + $request->lmuc44 + $request->lmuc45
                            + $request->lmuc51 + $request->lmuc52 + $request->lmuc53 + $request->lmuc54,
                    ]);
            }
        }
        return redirect()->back();
    }

    public function lec_crawlTKB(Request $request)
    {
        //dd(Session::get('maND'));
        // Lấy mã sinh viên từ request
        $maGV = Session::get('maND');
        //dd($maGV);

        // Tạo một đối tượng Goutte Client
        $client = new Client();

        // Gửi yêu cầu POST đến trang web cần crawl với dữ liệu mã sinh viên
        $crawler = $client->request('POST', 'http://daotao.ute.udn.vn/lectkb.asp', [
            'maGV' => $maGV,
        ]);
//        dd($crawler);
        $content = $crawler->filter('table > tr')->each(function ($node) {
            // Lấy nội dung của từng cột trong mỗi hàng
            $columns = $node->filter('td')->each(function ($column) {
                return $column->text();
            });
            if (count($columns) == 8) {
                return $columns;
            }
            // Trả về mảng chứa thông tin của thời khóa biểu
        });


        //dd($content);

        // Trả về dữ liệu thời khóa biểu đã đọc từ file Excel
        return view('admin.pages.product.TKB', ['tkbData' => $content]);
    }

    public function export_students()
    {
        $gvcn = Session('maND');
        $students = DB::table('sinhvien')
            ->leftJoin('lop', 'lopID', '=', 'maLop')
            ->where('gvcn', '=', $gvcn)
            ->orderBy('sinhvien.maSV')
            ->get();
        // Lấy danh sách sinh viên từ model
        //dd($students);

        // Tạo đối tượng Writer
        $writer = WriterEntityFactory::createXLSXWriter();

        // $writer = WriterEntityFactory::createWriter(Type::XLSX);

        // Mở file để ghi dữ liệu
        $lopCN = Session::get('lopCN');

        $filePath = public_path('/DSSV_'.$lopCN.'.xlsx');
        $writer->openToFile($filePath);

        // Ghi tiêu đề cột
        $header = ['STT', 'Mã SV', 'Họ và tên', 'Lớp', 'Năm sinh', 'Quê quán', 'SĐT', 'Giới tính', 'Mật khẩu'];
        $headerRow = WriterEntityFactory::createRowFromArray($header);
        $writer->addRow($headerRow);

        // Ghi dữ liệu sinh viên
        $stt = 1;
        foreach ($students as $student) {
            $dataRow = WriterEntityFactory::createRowFromArray(
                [
                    $stt++,
                    $student->maSV,
                    $student->tenSV,
                    $student->lopID,
                    $student->namsinh,
                    $student->quequan,
                    $student->sodienthoai,
                    $student->gioitinh,
                    $student->matkhau]);
            $writer->addRow($dataRow);
        }

        // Đóng đối tượng Writer
        $writer->close();

        // Trả về file đính kèm
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
