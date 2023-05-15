@extends('admin.layout', ['title' => 'Điểm rèn luyện'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THỜI GIAN CHẤM ĐIỂM RÈN LUYỆN HỌC KÌ {{Session::get('hkDangMo')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Điểm rèn luyện</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <form action="{{ route('chamdiemrenluyen.score.viewScoreHocKi') }}" method="get">
            @csrf
            <div class="d-flex">
                <select class="form-control d-inline-block" name="hockiID">
                    @foreach($hocki as $key => $value )
                        @if(Session::get('hk') != $value -> id)
                            <option value="{{ $value -> id }}">Học kì {{ $value -> id }}</option>
                        @else
                            <option selected value="{{ $value -> id }}">Học kì {{ $value -> id }}</option>
                        @endif
                    @endforeach
                </select>
                <button class="btn btn-success" type="submit">Xem</button>
            </div>
        </form>
        <form action="{{ route('chamdiemrenluyen.score.update', Session::get('maND')) }}" method="POST">
        @csrf
        <!-- Default box -->
            <div class="card">

                <div>
                    @if(session('overtime'))
                        <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                            {{session('overtime')}}
                        </div>
                    @endif
                    @if(session('updated'))
                        <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                            {{session('updated')}}
                        </div>
                    @endif
                    @if(session('nottime'))
                        <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-warning">
                            {{session('nottime')}}
                        </div>
                    @endif
                </div>
                <div class="content">

                    <!-- Default box -->
                    <div class="card">

                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>

                                <tr class="badge-secondary">
                                    <th>NỘI DUNG ĐÁNH GIÁ</th>
                                    <th>THANG ĐIỂM</th>
                                    <th>ĐIỂM SVTĐG</th>
                                    <th>ĐIỂM LỚP ĐG</th>
                                    <th>ĐIỂM KHOA ĐG</th>
                                    <th>ĐIỂM CÔNG BỐ</th>
                                </tr>
                                </thead>
                                <tbody id="detail_order">

                                <tr>
                                    <th></th>
                                    <th>100</th>
                                    @if(isset($diemTDG))
                                        <th>
                                            @if(($diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5)>=90)
                                                <p>{{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}</p>
                                                <span class="badge badge-primary">Xuất sắc</span>
                                            @elseif(($diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5)>=80)
                                                <p>{{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}</p>
                                                <span class="badge badge-info">Giỏi</span>
                                            @elseif(($diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5)>=65)
                                                <p>{{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}</p>
                                                <span class="badge badge-secondary">Khá</span>
                                            @elseif(($diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5)>=50)
                                                <p>{{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}</p>
                                                <span class="badge badge-warning">Trung bình</span>
                                            @else
                                                <p>{{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}</p>
                                                <span class="badge badge-danger">Yếu</span>
                                            @endif
                                        </th>
                                    @endif
                                    <th>
                                        @if(isset($bangdiem))
                                            @if($bangdiem-> diemLDG >=90)
                                                <p>{{$bangdiem-> diemLDG}}</p>
                                                <span class="badge badge-primary">Xuất sắc</span>
                                            @elseif($bangdiem-> diemLDG>=80)
                                                <p>{{$bangdiem-> diemLDG}}</p>
                                                <span class="badge badge-info">Giỏi</span>
                                            @elseif($bangdiem-> diemLDG>=65)
                                                <p>{{$bangdiem-> diemLDG}}</p>
                                                <span class="badge badge-secondary">Khá</span>
                                            @elseif($bangdiem-> diemLDG>=50)
                                                <p>{{$bangdiem-> diemLDG}}</p>
                                                <span class="badge badge-warning">Trung bình</span>
                                            @else
                                                <p>{{$bangdiem-> diemLDG}}</p>
                                                <span class="badge badge-danger">Yếu</span>
                                            @endif
                                        @endif
                                    </th>
                                    <th>
                                        @if(isset($bangdiem))
                                            @if($bangdiem-> diemKDG >=90)
                                                <p>{{$bangdiem-> diemKDG}}</p>
                                                <span class="badge badge-primary">Xuất sắc</span>
                                            @elseif($bangdiem-> diemKDG>=80)
                                                <p>{{$bangdiem-> diemKDG}}</p>
                                                <span class="badge badge-info">Giỏi</span>
                                            @elseif($bangdiem-> diemKDG>=65)
                                                <p>{{$bangdiem-> diemKDG}}</p>
                                                <span class="badge badge-secondary">Khá</span>
                                            @elseif($bangdiem-> diemKDG>=50)
                                                <p>{{$bangdiem-> diemKDG}}</p>
                                                <span class="badge badge-warning">Trung bình</span>
                                            @else
                                                <p>{{$bangdiem-> diemKDG}}</p>
                                                <span class="badge badge-danger">Yếu</span>
                                            @endif
                                        @endif
                                    </th>
                                    <th>
                                        @if(isset($bangdiem))
                                            @if($bangdiem-> diemCC >=90)
                                                <p>{{$bangdiem-> diemCC}}</p>
                                                <span class="badge badge-primary">Xuất sắc</span>
                                            @elseif($bangdiem-> diemCC>=80)
                                                <p>{{$bangdiem-> diemCC}}</p>
                                                <span class="badge badge-info">Giỏi</span>
                                            @elseif($bangdiem-> diemCC>=65)
                                                <p>{{$bangdiem-> diemCC}}</p>
                                                <span class="badge badge-secondary">Khá</span>
                                            @elseif($bangdiem-> diemCC>=50)
                                                <p>{{$bangdiem-> diemCC}}</p>
                                                <span class="badge badge-warning">Trung bình</span>
                                            @else
                                                <p>{{$bangdiem-> diemCC}}</p>
                                                <span class="badge badge-danger">Yếu</span>
                                            @endif
                                        @endif
                                    </th>
                                </tr>
                                <tr>
                                    <th>I. ĐÁNH GIÁ VỀ Ý THỨC THAM GIA HỌC TẬP.</th>
                                    <th>20</th>
                                    <th>
                                        <input value="@if($diemTDG){{$diemTDG->muc1}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input value="@if($diemLDG){{$diemLDG->muc1}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có đi học chuyên cần, đúng giờ, nghiêm túc trong giờ học; đủ điều kiện dự thi
                                        tất
                                        cả các học phần.
                                    </th>
                                    <th>4</th>
                                    <th>
                                        <input min="0" max="4" name="muc11"
                                               value="@if($diemTDG){{$diemTDG->muc11}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="4" name="lmuc11"
                                               value="@if($diemLDG){{$diemLDG->muc11}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>

                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tham gia các câu lạc bộ học thuật, các hoạt động học thuật, hoạt
                                        động ngoại khóa.
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc12"
                                               value="@if($diemTDG){{$diemTDG->muc12}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc12"
                                               value="@if($diemLDG){{$diemLDG->muc12}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có đăng ký, thực hiện, báo cáo đề tài NCKH đúng tiến độ hoặc đăng ký, tham
                                        dự kỳ thi sinh viên.
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc13"
                                               value="@if($diemTDG){{$diemTDG->muc13}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc13"
                                               value="@if($diemLDG){{$diemLDG->muc13}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Không vi phạm quy chế thi và kiểm tra.</th>
                                    <th>6</th>
                                    <th>
                                        <input min="0" max="6" name="muc14"
                                               value="@if($diemTDG){{$diemTDG->muc14}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="6" name="lmuc14"
                                               value="@if($diemLDG){{$diemLDG->muc14}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Được tập thể lớp công nhận có tinh thần vượt khó, phấn đấu vươn lên trong học
                                        tập.
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc15"
                                               value="@if($diemTDG){{$diemTDG->muc15}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc15"
                                               value="@if($diemLDG){{$diemLDG->muc15}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- ĐTBCHK từ 3,2 đến 4,0: 4 điểm <br>
                                        - ĐTBCHK từ 2,0 đến 3,19: 2 điểm<br>
                                        - ĐTBCHK dưới 2,0: 0 điểm
                                    </th>
                                    <th>4</th>
                                    <th>
                                        <input min="0" max="4" pattern="{0,2,4}" name="muc16"
                                               value="@if($diemTDG){{$diemTDG->muc16}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="4" pattern="{0,2,4}" name="lmuc16"
                                               value="@if($diemLDG){{$diemLDG->muc16}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>

                                <tr>
                                    <th>II. ĐÁNH GIÁ VỀ Ý THỨC CHẤP HÀNH NỘI QUY, QUY CHẾ TRONG NHÀ TRƯỜNG.</th>
                                    <th>25</th>
                                    <th>
                                        <input value="@if($diemTDG){{$diemTDG->muc2}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input value="@if($diemLDG){{$diemLDG->muc2}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức chấp hành các văn bản chỉ đạo của ngành, cấp trên và ĐHĐN được
                                        thực hiện trong nhà trường.
                                    </th>
                                    <th>6</th>
                                    <th>
                                        <input min="0" max="6" name="muc21"
                                               value="@if($diemTDG){{$diemTDG->muc21}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="6" name="lmuc21"
                                               value="@if($diemLDG){{$diemLDG->muc21}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tham gia đầy đủ, đạt yêu cầu các cuộc vận động, sinh hoạt chính trị.
                                    </th>
                                    <th>4</th>
                                    <th>
                                        <input min="0" max="4" name="muc22"
                                               value="@if($diemTDG){{$diemTDG->muc22}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="4" name="lmuc22"
                                               value="@if($diemLDG){{$diemLDG->muc22}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức chấp hành nội quy, quy chế và các quy định của nhà trường.</th>
                                    <th>10</th>
                                    <th>
                                        <input min="0" max="10" name="muc23"
                                               value="@if($diemTDG){{$diemTDG->muc23}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="10" name="lmuc23"
                                               value="@if($diemLDG){{$diemLDG->muc23}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Đóng học phí và các khoản thu khác đầy đủ, đúng hạn.</th>
                                    <th>5</th>
                                    <th>
                                        <input min="0" max="5" name="muc24"
                                               value="@if($diemTDG){{$diemTDG->muc24}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="5" name="lmuc24"
                                               value="@if($diemLDG){{$diemLDG->muc24}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>III. ĐÁNH GIÁ VỀ Ý THỨC THAM GIA CÁC HOẠT ĐỘNG CHÍNH TRỊ- XÃ HỘI, VHVN,
                                        TDTT, PHÒNG CHỐNG TỘI PHẠM VÀ CÁC TỆ NẠN XÃ HỘI.
                                    </th>
                                    <th>20</th>
                                    <th>
                                        <input value="@if($diemTDG){{$diemTDG->muc3}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input value="@if($diemLDG){{$diemLDG->muc3}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Tham gia đầy đủ, đạt yêu cầu “ Tuần sinh hoạt công dân sinh viên” đầu khóa
                                        năm học và cuối khóa.
                                    </th>
                                    <th>10</th>
                                    <th>
                                        <input min="0" max="10" name="muc31"
                                               value="@if($diemTDG){{$diemTDG->muc31}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="10" name="lmuc31"
                                               value="@if($diemLDG){{$diemLDG->muc31}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tham gia đầy đủ, nghiêm túc hoạt động rèn luyện về chính trị, xã
                                        hội,
                                        văn hóa, văn nghệ, thể thao do nhà trường và ĐHĐN tổ chức, điều động.
                                    </th>
                                    <th>6</th>
                                    <th>
                                        <input min="0" max="6" name="muc32"
                                               value="@if($diemTDG){{$diemTDG->muc32}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="6" name="lmuc32"
                                               value="@if($diemLDG){{$diemLDG->muc32}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tham gia các hoạt động công ích, tình nguyện, công tác xã hội trong
                                        nhà trường.
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc33"
                                               value="@if($diemTDG){{$diemTDG->muc33}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc33"
                                               value="@if($diemLDG){{$diemLDG->muc33}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tuyên truyền, phòng chống tội phạm và các tệ nạn xã hội.</th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc34"
                                               value="@if($diemTDG){{$diemTDG->muc34}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc34"
                                               value="@if($diemLDG){{$diemLDG->muc34}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>IV. ĐÁNH GIÁ VỀ Ý THỨC CÔNG DÂN TRONG QUAN HỆ VỚI CỘNG ĐỒNG.</th>
                                    <th>25</th>
                                    <th>
                                        <input disabled value="@if($diemTDG){{$diemTDG->muc4}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input disabled value="@if($diemLDG){{$diemLDG->muc4}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức chấp hành, tham gia tuyên truyền các chủ trương của Đảng, chính
                                        sách, pháp luật của Nhà nước.
                                    </th>
                                    <th>4</th>
                                    <th>
                                        <input min="0" max="4" name="muc41"
                                               value="@if($diemTDG){{$diemTDG->muc41}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="4" name="lmuc41"
                                               value="@if($diemLDG){{$diemLDG->muc41}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có tham gia bảo hiểm y tế ( bắt buộc) theo Luật bảo hiểm y tế.</th>
                                    <th>10</th>
                                    <th>
                                        <input min="0" max="10" name="muc42"
                                               value="@if($diemTDG){{$diemTDG->muc42}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="10" name="lmuc42"
                                               value="@if($diemLDG){{$diemLDG->muc42}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức chấp hành, tham gia tuyên truyền các quy định về đảm bảo an toàn
                                        giao thông và “văn hóa giao thông”.
                                    </th>
                                    <th>5</th>
                                    <th>
                                        <input min="0" max="5" name="muc43"
                                               value="@if($diemTDG){{$diemTDG->muc43}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="5" name="lmuc43"
                                               value="@if($diemLDG){{$diemLDG->muc43}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức tham gia các hoạt động xã hội có thành tích được ghi nhận, biểu
                                        dương khen thưởng.
                                    </th>
                                    <th>4</th>
                                    <th>
                                        <input min="0" max="4" name="muc44"
                                               value="@if($diemTDG){{$diemTDG->muc44}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="4" name="lmuc44"
                                               value="@if($diemLDG){{$diemLDG->muc44}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có tinh thần chia sẻ, giúp đỡ người gặp khó khăn, hoạn nạn.</th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc45"
                                               value="@if($diemTDG){{$diemTDG->muc45}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc45"
                                               value="@if($diemLDG){{$diemLDG->muc45}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                {{--                            muc5--}}
                                <tr>
                                    <th>V. ĐÁNH GIÁ VỀ Ý THỨC VÀ KẾT QUẢ KHI THAM GIA CÔNG TÁC CÁN BỘ LỚP,
                                        CÁC ĐOÀN THỂ, TỔ CHỨC TRONG NHÀ TRƯỜNG HOẶC SINH VIÊN ĐẠT ĐƯỢC
                                        THÀNH TÍCH TRONG HỌC TẬP, RÈN LUYỆN
                                    </th>
                                    <th>10</th>
                                    <th>
                                        <input value="@if($diemTDG){{$diemTDG->muc5}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input value="@if($diemLDG){{$diemLDG->muc5}}@endif" disabled
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có ý thức, uy tín và hoàn thành tốt nhiệm vụ quản lý lớp, các tổ chức Đảng,
                                        Đoàn Thanh niên, Hội Sinh viên, tổ chức khác trong nhà trường.
                                    </th>
                                    <th>3</th>
                                    <th>
                                        <input min="0" max="3" name="muc51"
                                               value="@if($diemTDG){{$diemTDG->muc51}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="3" name="lmuc51"
                                               value="@if($diemLDG){{$diemLDG->muc51}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Có kỹ năng tổ chức, quản lý lớp, các tổ chức Đảng, Đoàn Thanh niên, Hội Sinh
                                        viên và các tổ chức khác trong nhà trường.
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc52"
                                               value="@if($diemTDG){{$diemTDG->muc52}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc52"
                                               value="@if($diemLDG){{$diemLDG->muc52}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Hỗ trợ tham gia tích cực vào các hoạt động chung của lớp, tập thể khoa, trường
                                        và Đại học Đà Nẵng.
                                    </th>
                                    <th>3</th>
                                    <th>
                                        <input min="0" max="3" name="muc53"
                                               value="@if($diemTDG){{$diemTDG->muc53}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="3" name="lmuc53"
                                               value="@if($diemLDG){{$diemLDG->muc53}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>- Đạt thành tích trong học tập, rèn luyện (được tặng bằng khen, giấy khen, chứng
                                        nhận, thư khen của các cấp).
                                    </th>
                                    <th>2</th>
                                    <th>
                                        <input min="0" max="2" name="muc54"
                                               value="@if($diemTDG){{$diemTDG->muc54}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input min="0" max="2" name="lmuc54"
                                               value="@if($diemLDG){{$diemLDG->muc54}}@endif"
                                               class="input-group-text w-50"
                                               type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input class="input-group-text w-50" type="number">
                                    </th>
                                </tr>
                                <tr>
                                    <th>VI. TỔNG SỐ ĐIỂM:</th>
                                    <th>100</th>
                                    <th>
                                        <input
                                            value="@if($diemTDG){{$diemTDG-> muc1 + $diemTDG-> muc2 + $diemTDG-> muc3 + $diemTDG-> muc4 + $diemTDG-> muc5}}@endif"
                                            disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input
                                            value="@if($diemLDG){{$diemLDG-> muc1 + $diemLDG-> muc2 + $diemLDG-> muc3 + $diemLDG-> muc4 + $diemLDG-> muc5}}@endif"
                                            disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                    <th>
                                        <input disabled class="input-group-text w-50" type="number">
                                    </th>
                                </tr>

                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <button type="submit" class="btn-outline-primary btn btn-group">Cập nhật
                                        </button>
                                    </th>
                                    <th></th>
                                    <th>
                                        {{--                                        <button class="btn-danger btn btn-group">Thắc mắc</button>--}}
                                    </th>
                                    <th></th>
                                </tr>

                                {{--                            @include('admin.pages.ajax.list_product_order')--}}
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div>
                        {{--<a class="btn btn-secondary" href="{{route('admin.order.index')}}">
                            <i class="fas fa-chevron-left"></i>
                        </a>--}}
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card -->
                </div>
            </div>
        </form>
    </section>

@endsection
