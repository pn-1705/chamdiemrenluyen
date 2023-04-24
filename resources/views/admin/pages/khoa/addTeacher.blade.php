@extends('admin.layout', ['title' => 'Thêm Giáo viên'])
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
                    <h1 class="font-weight-bold text-uppercase">THÊM Giáo viên</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Giáo viên</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-6">
                <!-- /.card-body -->
                <form action="{{ route("chamdiemrenluyen.giaovien.post") }}" method="POST">
                    @csrf
                    <div class="card card-primary">
                        <div>
                            @if(session('thieutruong'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                                    {{session('thieutruong')}}
                                </div>
                            @endif
                            @if(session('tontai'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-warning">
                                    {{session('tontai')}}
                                </div>
                            @endif
                            <div class="card-body d-flex">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="inputName">Mã GV</label>
                                        <input value="" name="maGV" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Tên</label>
                                        <input value="" name="ten" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Số điện thoại</label>
                                        <input value="" name="sdt" type="text" maxlength="10"
                                               id="inputName" class="form-control">
                                    </div><div class="form-group">
                                        <label for="inputName">Email</label>
                                        <input value="" name="email" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                                class="text-uppercase btn btn-outline-primary float-right">thêm
                                        </button>
                                    </div>
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="inputName">Học hàm</label>
                                        <input value="" name="hocham" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Địa chỉ</label>
                                        <input value="" name="diachi" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Mật khẩu</label>
                                        <input value="" name="matkhau" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Năm sinh</label>
                                        <input value="" name="namsinh" type="date"
                                               id="inputName" class="form-control">
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
