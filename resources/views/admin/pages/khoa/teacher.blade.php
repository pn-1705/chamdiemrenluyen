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
                    <h1 class="font-weight-bold text-uppercase">Giáo viên</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">GVCN</li>
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
                        <th><a href="{{ route("chamdiemrenluyen.giaovien.add")}}" class="btn btn-primary">THÊM</a></th>
                        <th></th>
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
                        <th>Mã GV</th>
                        <th>Họ và tên</th>
                        <th>Năm sinh</th>
                        <th>Quê quán</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>SĐT</th>
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
                            <td>{{ $value -> ten }}</td>
                            <td>{{ $value -> namsinh }}</td>
                            <td>{{ $value ->diachi }}</td>
                            <td>{{ $value ->email }}</td>
                            <td>{{ $value ->matkhau }}</td>
                            <td>{{ $value ->sdt }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-info btn-sm"
                                   href="{{ route("chamdiemrenluyen.giaovien.edit",  $value -> maGV ) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>
                                <a class="btn btn-danger btn-sm"
                                   href="{{ route("chamdiemrenluyen.giaovien.del",  $value -> maGV ) }}">
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
