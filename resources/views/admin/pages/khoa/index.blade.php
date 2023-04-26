<?php $khoa = Session::get('ten') ?>
@extends('admin.layout', ['title' => $khoa])
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
                    <h1 class="font-weight-bold text-uppercase">Khoa {{Session::get('ten')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Khoa {{Session::get('ten')}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-inline-block d-flex">

        </div>
        <!-- Default box -->
        <div class="card">
            <div>
                @if(session('del'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                        {{session('del')}}
                    </div>
                @endif
                @if(session('updated'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('updated')}}
                    </div>
                @endif
                @if(session('add'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('add')}}
                    </div>
                @endif
            </div>
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th colspan="3">
                            <div>
                                <form action="{{route('chamdiemrenluyen.qlsv.search')}}" class="form-inline"
                                      method="GET">
                                    @csrf
                                    <input value="@if(isset($id)){{$id}} @endif" class="form-control" name="student" type="text"
                                           placeholder="Nhập sinh viên cần tìm...">
                                    <select class="form-control" name="lopID" id="">
                                        <option value="">Lớp</option>
                                        @foreach($listClass as $key => $value)
                                            <option @if(isset($lopID)){{$lopID == $value->maLop ? 'selected' : '' }} @endif value="{{$value->maLop}}">{{$value->maLop}}</option>
                                        @endforeach
                                    </select>
                                    <button class="form-control btn-outline-dark btn" type="submit"><i
                                            class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>Mã SV</th>
                        <th>Họ và tên</th>
                        <th>Lớp</th>
                        <th>Ngành</th>
                        <th>Năm sinh</th>
                        <th>Quê quán</th>
                        <th>SĐT</th>
                        <th>Giới tính</th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tbProduct">
                    <?php $i = 1;
                    ?>
                    @foreach($listStudent as $key => $value)

                        <tr>
                            <td><?php echo $i++;
                                ?></td>
                            <td>{{ $value -> maSV }}</td>
                            <td>{{ $value -> tenSV }}</td>
                            <td>{{ $value -> lopID }}</td>
                            <td>{{ $value -> nganh }}</td>
                            <td>{{ $value -> namsinh }}</td>
                            {{--                            <td class="">--}}
                            {{--                                {{ number_format(($value -> DonGia),0,',','.') }}--}}
                            {{--                                <small>VNĐ</small>--}}
                            {{--                            </td>--}}
                            {{--                            <td class="project-state">{{ $value -> SoLuong }}</td>--}}
                            <td>{{ $value ->quequan }}</td>
                            <td>{{ $value ->sodienthoai }}</td>
                            <td>{{ $value ->gioitinh }}</td>
                            {{--                            <td class="project-state">--}}
                            {{--                                @if($value -> TrangThai == 1)--}}
                            {{--                                    <a href="{{ route("admin.product.active",  $value -> id ) }}"><span--}}
                            {{--                                            class="badge badge-primary">Hiện</span></a>--}}
                            {{--                                @else--}}
                            {{--                                    <a href="{{ route("admin.product.active",  $value -> id ) }}"><span--}}
                            {{--                                            class="badge badge-secondary">Ẩn</span></a>--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("admin.product.edit",  $value -> maSV ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm"
                                   href="{{ route("admin.product.getDestroy",  $value -> maSV ) }}">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
@endsection
