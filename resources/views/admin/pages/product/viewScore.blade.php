<?php $role = Session::get('Quyen_id');
if ($role == 1) {
    $tt = 'Khoa ' . Session::get('tenKhoa');
} else {
    $tt = 'Lớp ' . Session::get('lopID');
}

?>
@extends('admin.layout', ['title' => $tt])
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
                    <h1 class="font-weight-bold text-uppercase">Điểm rèn luyện {{$tt}}</h1>
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
        <div class="d-inline-block d-flex">
            <form class="d-flex" action="{{ route('chamdiemrenluyen.viewScore.hocki')}}" method="POST">
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
                <button class="btn-outline-dark btn" type="submit"><i class="fa fa-search"></i></button>
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
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th  {{$role == 1 ? 'hidden' : ''}}><a class="btn btn-info btn-sm"
                               href="{{--{{ route("admin.product.edit",  $value -> maSV ) }}--}}">
                                Duyệt tất cả
                            </a></th>
                        <th></th>
                        <th {{$role == 2 ? 'hidden' : ''}}><a class="btn btn-info btn-sm"
                               href="{{--{{ route("admin.product.edit",  $value -> maSV ) }}--}}">
                                Duyệt tất cả
                            </a></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>STT</th>
                        <th>Mã SV</th>
                        <th>Họ và tên</th>
                        {{--                        <th>--}}
                        {{--                            <select style="border: none; font-weight: bold" onchange="sortCate_Product()"--}}
                        {{--                                    class="font-weight-bold" id="sortCate_Pr">--}}
                        {{--                                <option value="">Danh mục</option>--}}
                        {{--                                @foreach($list_cate as $key => $value )--}}
                        {{--                                    <option value="{{ $value -> TenDM }}">{{ $value -> TenDM }}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </th>--}}
                        {{--                        <th>--}}
                        {{--                            <select style="border: none; font-weight: bold" onchange="sortBrand_Product()"--}}
                        {{--                                    class="font-weight-bold" id="sortBrand_Pr">--}}
                        {{--                                <option value="">Thương hiệu</option>--}}
                        {{--                                @foreach($list_brand as $key => $value )--}}
                        {{--                                    <option value="{{ $value -> TenLSP }}">{{ $value -> TenLSP }}</option>--}}
                        {{--                                @endforeach--}}
                        {{--                            </select>--}}
                        {{--                        </th>--}}
                        <th>Số điện thoại</th>
                        <th>Quê quán</th>
                        <th class="text-right">SVTĐG</th>
                        <th {{$role == 1 ? 'hidden' : ''}}></th>
                        <th class="text-right">Lớp ĐG</th>
                        <th {{$role == 2 ? 'hidden' : ''}}></th>
                        <th>Khoa ĐG</th>
                        <th></th>
                        {{--                        <th>--}}
                        {{--                            <select onchange="sortStatus_Product()" class="font-weight-bold" style="border: none; "--}}
                        {{--                                    name="" id="sortStatus_Pr">--}}
                        {{--                                <option value="">Trạng thái</option>--}}
                        {{--                                <option value="Ẩn">Ẩn</option>--}}
                        {{--                                <option value="Hiện">Hiện</option>--}}
                        {{--                            </select>--}}
                        {{--                        </th>--}}
                    </tr>
                    </thead>
                    <tbody id="tbBangDiem">
                    <?php $i = 0;
                    ?>
                    @foreach($listScore as $key => $value)

                        <tr>

                            {{--                            <td>--}}
                            {{--                                <ul class="list-inline">--}}
                            {{--                                    <li class="list-inline-item">--}}
                            {{--                                        <img alt="Avatar" class="concac"--}}
                            {{--                                             src="{{ asset('public/backend/'. $value -> HinhAnh1) }}">--}}
                            {{--                                    </li>--}}
                            {{--                                    <li class="list-inline-item">--}}
                            {{--                                        <img alt="Avatar" class="concac"--}}
                            {{--                                             src="{{ asset('public/backend/'. $value -> HinhAnh2) }}">--}}
                            {{--                                    </li>--}}
                            {{--                                    <li class="list-inline-item">--}}
                            {{--                                        <img alt="Avatar" class="concac"--}}
                            {{--                                             src="{{ asset('public/backend/'. $value -> HinhAnh3) }}">--}}
                            {{--                                    </li>--}}
                            {{--                                </ul>--}}
                            {{--                            </td>--}}

                            <td> <?php $i++;
                                echo $i
                                ?></td>
                            <td>{{ $value -> maND }}</td>
                            <td>{{ $value -> tenSV }}</td>
                            <td>{{ $value -> sodienthoai }}</td>
                            <td>{{ $value -> quequan }}</td>

                            <td class="text-right">{{ $value -> diemTDG }} </td>
                            <td {{$role == 1 ? 'hidden' : ''}}><a class="btn btn-info btn-sm {{ ($value -> diemTDG) == null ? 'disabled' : '' }}"
                                   href="{{ route("chamdiemrenluyen.viewScore.duyet", $value -> maND,$value -> diemTDG) }}">
                                    Duyệt
                                </a></td>
                            {{--                            <td class="">--}}
                            {{--                                {{ number_format(($value -> DonGia),0,',','.') }}--}}
                            {{--                                <small>VNĐ</small>--}}
                            {{--                            </td>--}}
                            {{--                            <td class="project-state">{{ $value -> SoLuong }}</td>--}}
                            <td class="text-right">{{ $value ->diemLDG }}</td>

                            <td {{$role == 2 ? 'hidden' : ''}}><a
                                    class="btn btn-info btn-sm {{ ($value -> diemTDG) == null ? 'disabled' : '' }}"
                                    href="{{ route("chamdiemrenluyen.viewScore.khoaduyet", $value -> maND,$value -> diemTDG) }}">
                                    Duyệt
                                </a></td>
                            {{--                            <td class="project-state">--}}
                            {{--                                @if($value -> TrangThai == 1)--}}
                            {{--                                    <a href="{{ route("admin.product.active",  $value -> id ) }}"><span--}}
                            {{--                                            class="badge badge-primary">Hiện</span></a>--}}
                            {{--                                @else--}}
                            {{--                                    <a href="{{ route("admin.product.active",  $value -> id ) }}"><span--}}
                            {{--                                            class="badge badge-secondary">Ẩn</span></a>--}}
                            {{--                                @endif--}}
                            {{--                            </td>--}}
                            <td>{{ $value ->diemKDG }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{--{{ route("admin.product.edit",  $value -> maSV ) }}--}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm"
                                   href="{{--{{ route("admin.product.getDestroy",  $value -> maSV ) }}--}}">
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
