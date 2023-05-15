<?php $role = Session::get('Quyen_id');?>
@extends('admin.layout', ['title' => 'Điểm rèn luyện'])
@section('content')
    <style>
        .concac {
            display: inline;
            width: 2.5rem;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold text-uppercase">quản lí Điểm rèn luyện</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Điểm rèn luyện</a></li>
                        <li class="breadcrumb-item active">Học kì {{Session::get('hk')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-inline-block">
            <form action="{{ route('chamdiemrenluyen.scoreManager.search')}}" method="get">
                <div>
                    @csrf
                    <select class="form-control d-inline-block" name="hockiID">
                        @foreach($listHocKi as $key => $value )
                            @if(Session::get('hk') != $value -> id)
                                <option value="{{ $value -> id }}">Học kì {{ $value -> id }}</option>
                            @else
                                <option selected value="{{ $value -> id }}">Học kì {{ $value -> id }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div>

                    @csrf
                    <div class="d-flex">
                        <select class="form-control" name="khoaID" id="">
                            <option value="">Khoa</option>
                            @foreach($listKhoa as $key => $value)
                                <option
                                    @if(isset($khoaID)){{$khoaID == $value->maKhoa ? 'selected' : '' }} @endif value="{{$value->maKhoa}}">{{$value->tenKhoa}}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="lopID" id="">
                            <option value="">Lớp</option>
                            @foreach($listClass as $key => $value)
                                <option
                                    @if(isset($lopID)){{$lopID == $value->maLop ? 'selected' : '' }} @endif value="{{$value->maLop}}">{{$value->maLop}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input value="@if(isset($id)){{$id}} @endif" class="form-control" name="student" type="text"
                           placeholder="Nhập sinh viên cần tìm...">
                    <button class="form-control btn-outline-dark btn" type="submit"><i
                            class="fa fa-search"></i>
                    </button>
                </div>
            </form>

        </div>
        <!-- Default box -->
        <div class="card">
            <div>
                @if(session('del'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                        {{session('del')}}
                    </div>
                @endif
                @if(session('duyet'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('duyet')}}
                    </div>
                @endif
                @if(session('add'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('add')}}
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                @if($listScore->count() == 0)
                    <div class="card-body">
                        <p>Không tìm thấy điểm rèn luyện học kì {{Session::get('hk')}}</p>
                    </div>
                @else
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            @if($role == 1)
                                <th></th>
                            @endif
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("chamdiemrenluyen.scoreManager.congnhantatca" ) }}">
                                    Công nhận tất cả
                                    <span class="badge-light badge">{{Session::get('lopID')}}</span>
                                </a>
                            </th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Họ và tên</th>
                            <th {{$role == 2 ? 'hidden' : ''}}>Lớp</th>
                            <th>Số điện thoại</th>
                            <th>Quê quán</th>
                            <th class="text-right">SVTĐG</th>
                            <th class="text-right">Lớp ĐG</th>
                            <th>Khoa ĐG</th>
                            <th></th>
                            <th>Đã công nhận</th>
                        </tr>
                        </thead>
                        <tbody id="tbBangDiem">
                        <?php $i = 0;
                        ?>
                        @foreach($listScore as $key => $value)

                            <tr>
                                <td> <?php $i++;
                                    echo $i
                                    ?></td>
                                <td>{{ $value -> maND }}</td>
                                <td>{{ $value -> tenSV }}</td>
                                <td {{$role == 2 ? 'hidden' : ''}}>{{ $value -> lopID }}</td>
                                <td>{{ $value -> sodienthoai }}</td>
                                <td>{{ $value -> quequan }}</td>

                                <td class="text-right
                                    @if($value -> diemTDG >=90)
                                    bg-success
@elseif($value -> diemTDG >=80)
                                    bg-primary
                                   @elseif($value -> diemTDG >=65)
                                    bg-secondary
                                   @elseif($value -> diemTDG >=50)
                                    bg-warning
                                   @elseif($value -> diemTDG >=35)
                                    bg-danger
                                   @else
                                    bg-dark
                                    @endif">{{ $value -> diemTDG }} </td>
                                <td class="text-right
                                        @if($value -> diemLDG >=90)
                                    bg-success
                                    @elseif($value -> diemLDG >=80)
                                    bg-primary
                                   @elseif($value -> diemLDG >=65)
                                    bg-secondary
                                   @elseif($value -> diemLDG >=50)
                                    bg-warning
                                   @elseif($value -> diemLDG >=35)
                                    bg-danger
                                   @else
                                    bg-dark
                                    @endif
                                    ">{{ $value ->diemLDG }}</td>
                                <td class="text-right @if($value -> diemKDG >=90)
                                    bg-success
@elseif($value -> diemKDG >=80)
                                    bg-primary
                                   @elseif($value -> diemKDG >=65)
                                    bg-secondary
                                   @elseif($value -> diemKDG >=50)
                                    bg-warning
                                   @elseif($value -> diemKDG >=35)
                                    bg-danger
                                   @else
                                    bg-dark
                                    @endif">{{ $value ->diemKDG }}</td>
                                <td {{$role == 1 ? 'hidden' : ''}}><a
                                        class="btn btn-info btn-sm {{ ($value -> diemKDG) == null ? 'disabled' : '' }}"
                                        href="{{ route("chamdiemrenluyen.scoreManager.congnhan", $value -> maND,$value -> diemKDG) }}">
                                        Công nhận
                                    </a><a
                                        class="btn btn-warning btn-sm {{ ($value -> diemKDG) == null ? 'disabled' : '' }}"
                                        href="{{ route("chamdiemrenluyen.viewScore.chamlai", $value -> maND,$value -> diemKDG) }}">
                                        Chấm lại
                                    </a></td>
                                <td class="text-right @if($value -> diemCC >=90)
                                    bg-success
@elseif($value -> diemCC >=80)
                                    bg-primary
                                   @elseif($value -> diemCC >=65)
                                    bg-secondary
                                   @elseif($value -> diemCC >=50)
                                    bg-warning
                                   @elseif($value -> diemCC >=35)
                                    bg-danger
                                   @else
                                    bg-dark
                                    @endif">{{ $value ->diemCC }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
