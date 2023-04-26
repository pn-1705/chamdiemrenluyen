<?php $role = Session::get('Quyen_id');
if ($role == 1) {
    $tt = 'Khoa ' . Session::get('tenKhoa');
} else {
    $tt = 'Lớp ' . Session::get('lopCN');
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
                            <th {{$role == 1 ? 'hidden' : ''}}><a class="btn btn-info btn-sm"
                                    href="{{ route("chamdiemrenluyen.viewScore.duyettatca" ) }}">
                                    Duyệt tất cả
                                </a></th>
                            <th></th>
                            <th {{$role == 2 ? 'hidden' : ''}}><a class="btn btn-info btn-sm"
                                                                  href="{{--{{ route("admin.product.edit",  $value -> maSV ) }}--}}">
                                    Duyệt tất cả
                                </a></th>
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
                            <th {{$role == 1 ? 'hidden' : ''}}></th>
                            <th class="text-right">Lớp ĐG</th>
                            <th {{$role == 2 ? 'hidden' : ''}}></th>
                            <th>Khoa ĐG</th>
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

                                <td class="text-right">{{ $value -> diemTDG }} </td>
                                <td {{$role == 1 ? 'hidden' : ''}}><a
                                        class="btn btn-info btn-sm {{ ($value -> diemTDG) == null ? 'disabled' : '' }}"
                                        href="{{ route("chamdiemrenluyen.viewScore.duyet", $value -> maND,$value -> diemTDG) }}">
                                        Duyệt
                                    </a><a
                                        class="btn btn-warning btn-sm {{ ($value -> diemTDG) == null ? 'disabled' : '' }}"
                                        href="{{ route("chamdiemrenluyen.viewScore.chamlai", $value -> maND,$value -> diemTDG) }}">
                                        Chấm lại
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
