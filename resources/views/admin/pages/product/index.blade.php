@extends('admin.layout', ['title' => 'Sinh viên'])
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
                    <h1 class="font-weight-bold text-uppercase">Danh sách sinh viên {{$listStudent[0]->maLop}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Sinh viên</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-inline-block d-flex">
            <div class="">
                <form class="form-inline" id="form_input">
                    <input class="form-control" name="product" type="text" placeholder="Nhập sinh viên cần tìm...">
                    <button class="btn-outline-dark btn" type="submit"><i class="fa fa-search"></i></button>
                </form>

            </div>
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
                        <th>Năm sinh</th>
                        <th>Quê quán</th>
                        <th>SĐT</th>
                        <th>Giới tính</th>
                        {{--                        <th>--}}
                        {{--                            <select onchange="sortStatus_Product()" class="font-weight-bold" style="border: none; "--}}
                        {{--                                    name="" id="sortStatus_Pr">--}}
                        {{--                                <option value="">Trạng thái</option>--}}
                        {{--                                <option value="Ẩn">Ẩn</option>--}}
                        {{--                                <option value="Hiện">Hiện</option>--}}
                        {{--                            </select>--}}
                        {{--                        </th>--}}
                        <th class="">
                            <a class="btn btn-success float-right"
                               href="{{ route("chamdiemrenluyen.export-students" ) }}"> Xuất
                                DSSV</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody id="tbProduct">
                    <?php $i = 1;
                    ?>
                    @foreach($listStudent as $key => $value)

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
                            <td><?php echo $i++;
                                ?></td>
                            <td>{{ $value -> maSV }}</td>
                            <td>{{ $value -> tenSV }}</td>
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
