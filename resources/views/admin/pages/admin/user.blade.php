@extends('admin.layout', ['title' => 'Người dùng'])
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
                    <h1 class="font-weight-bold text-uppercase">Người dùng</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Người dùng</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="col-md-12">
            <div>
                @if(session('error'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                        {{session('error')}}
                    </div>
                @endif
                @if(session('suscess'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-success">
                        {{session('suscess')}}
                    </div>
                @endif
                @if(session('excel_error'))
                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-default-warning">
                        {{session('excel_error')}}
                    </div>
                @endif
            </div>
            <div class="card card-body p-0">
                @if(isset($listSV))
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <form action="{{ route("chamdiemrenluyen.user.sinhvien.nhap_excel") }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <th colspan="2"><input class="input-group-text" type="file" name="excel_file"></th>
                                <th class="text-right">
                                    <button class="btn btn-primary" type="submit">Nhập sinh viên</button>
                                </th>
                            </form>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Mã SV</th>
                            <th>Họ và tên</th>
                            <th>Năm sinh</th>
                            <th>Quê quán</th>
                            <th>SĐT</th>
                            <th>Mật khẩu</th>
                            <th>Giới tính</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($listSV as $key => $value)

                            <tr>
                                <td><?php echo $i++;
                                    ?></td>
                                <td>{{ $value -> maSV }}</td>
                                <td>{{ $value -> tenSV }}</td>
                                <td>{{ $value -> namsinh }}</td>
                                <td>{{ $value ->quequan }}</td>
                                <td>{{ $value ->sodienthoai }}</td>
                                <td>{{ $value ->matkhau }}</td>
                                <td>{{ $value ->gioitinh }}</td>
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

                @endif
                @if(isset($listGV))
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã GV</th>
                            <th>Họ và tên</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>
                            <th>Mật khẩu</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($listGV as $key => $value)

                            <tr>
                                <td><?php echo $i++;
                                    ?></td>
                                <td>{{ $value -> maGV }}</td>
                                <td>{{ $value->hocham.'. '.$value -> ten }}</td>
                                <td>{{ $value ->diachi }}</td>
                                <td>{{ $value ->sdt }}</td>
                                <td>{{ $value ->matkhau }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route("admin.product.edit",  $value -> maGV ) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="{{ route("admin.product.getDestroy",  $value -> maGV ) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                @if(isset($listBCNKhoa))
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th><a href="{{ route("chamdiemrenluyen.khoa.user.bqlkhoa.add")}}" class="btn btn-primary">THÊM</a>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Mã BCN</th>
                            <th>Khoa</th>
                            <th>Trưởng khoa</th>
                            <th>SĐT</th>
                            <th>Mật khẩu</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($listBCNKhoa as $key => $value)

                            <tr>
                                <td><?php echo $i++;
                                    ?></td>
                                <td>{{ $value -> maBCN }}</td>
                                <td>{{ $value -> tenKhoa }}</td>
                                <td>{{ $value->hocham.'. '.$value -> ten }}</td>
                                <td>{{ $value ->sdt }}</td>
                                <td>{{ $value ->matkhau }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                       href="{{ route("admin.product.edit",  $value -> maBCN ) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="{{ route("admin.product.getDestroy",  $value -> maBCN ) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
                @if(isset($admin))
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã ND</th>
                            <th>Mật khẩu</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($admin as $key => $value)

                            <tr>
                                <td><?php echo $i++;
                                    ?></td>
                                <td>{{ $value -> maND }}</td>
                                <td>{{ $value ->matkhau }}</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-info btn-sm"
                                       href="{{--{{ route("admin.product.edit" ) }}--}}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm"
                                       href="{{--{{ route("admin.product.getDestroy" ) }}--}}">
                                        <i class="fas fa-trash">
                                        </i>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
            <!-- /.card-body -->
        </div><!-- /.card -->
    </section>
@endsection
