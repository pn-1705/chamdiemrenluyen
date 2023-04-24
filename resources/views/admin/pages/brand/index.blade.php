@extends('admin.layout', ['title' => 'Profile'])
@section('content')
    <style>
        .concac {
            display: inline;
            width: 8rem;
        }
    </style>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>THÔNG TIN CÁ NHÂN</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Thông tin cá nhân</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-7">
                <form action="{{ route("chamdiemrenluyen.profile.update", $user-> maND) }}" method="POST">
                    @csrf
                    <div class="card card-primary">
                        <div>
                            <div class="font-weight-bold card-header">CẬP NHẬT THÔNG TIN</div>
                            @if(session('updated'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-success">
                                    {{session('updated')}}
                                </div>
                            @endif
                            <div class="card-body d-flex">
                                <div class="col-md-6 form-group">
                                    <div class="form-group">
                                        @if(isset($user -> maSV))

                                            <label for="inputName">Mã sinh viên</label>
                                            <input disabled value="{{ $user -> maND }}" name="HoTen" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                        @if(isset($user -> maGV))

                                            <label for="inputName">Mã giáo viên</label>
                                            <input disabled value="{{ $user -> maND }}" name="HoTen" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Họ và tên</label>
                                        @if(isset($user -> tenSV))
                                            <input disabled
                                                   value="{{$user -> tenSV}}
                                                       " name="HoTen" type="text"
                                                   id="inputName"
                                                   class="form-control">
                                        @endif
                                        @if(isset($user -> ten))
                                            <input disabled
                                                   value="{{ $user -> ten }}
                                                       " name="HoTen" type="text"
                                                   id="inputName"
                                                   class="form-control">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Email</label>
                                        <input disabled value="{{ $user -> maND }}@sv.ute.udn.vn" name="email"
                                               type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        @if(isset($user -> lopID))
                                            <label for="inputName">Lớp</label>
                                            <input disabled value="{{ $user -> lopID }}" name="username" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                        @if(isset($user -> khoaID))
                                            <label for="inputName">Khoa</label>
                                            <input disabled value="{{ $user ->tenKhoa }}" name="username" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                    </div>


                                </div>
                                <div class="col-md-6 form-group">
                                    <div class="form-group">
                                        <label for="inputName">Giới tính</label>
                                        <select class="form-control" name="gioitinh" id="inputName">
                                            @if($user -> gioitinh == 'Nam')
                                                <option selected value="Nam">Nam</option>
                                                <option value="Nữ">Nữ</option>

                                            @else
                                                <option value="Nam">Nam</option>
                                                <option selected value="Nữ">Nữ</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        @if(isset($user -> quequan))

                                            <label for="inputName">Quê quán</label>
                                            <input value="{{ $user -> quequan }}" name="quequan" type="text"
                                                   id="inputName"
                                                   class="form-control">
                                        @endif
                                        @if(isset($user -> diachi))

                                            <label for="inputName">Địa chỉ</label>
                                            <input value="{{ $user -> diachi }}" name="quequan" type="text"
                                                   id="inputName"
                                                   class="form-control">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if(isset($user -> sodienthoai))

                                            <label for="inputName">SĐT</label>
                                            <input value="{{ $user -> sodienthoai }}" name="sdt" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                        @if(isset($user -> sdt))

                                            <label for="inputName">SĐT</label>
                                            <input value="{{ $user -> sdt }}" name="sdt" type="text"
                                                   id="inputName" class="form-control">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Năm sinh</label>
                                        <input value="{{ $user -> namsinh }}" name="namsinh" type="date"
                                               id="inputName"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary float-right">Cập nhật
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->

                    </div>
                </form>

                <!-- /.card -->
            </div>

            <div class="col-md-5">
                <form action="{{ route("chamdiemrenluyen.profile.changePassword", $user-> maND) }}" method="POST">
                    @csrf
                    <div class="card card-primary">
                        <div>
                            <div class="font-weight-bold card-header">THAY ĐỔI MẬT KHẨU</div>
                            @if(session('error'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif
                            @if(session('updatedPassword'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-success">
                                    {{session('updatedPassword')}}
                                </div>
                            @endif
                            <div class="card-body d-flex">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="inputName">Mật khẩu cũ</label>
                                        <input value="" name="oldpassword" type="password"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Mật khẩu mới</label>
                                        <input value="" name="newpassword" type="password"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Xác nhận mật khẩu</label>
                                        <input value="" name="repassword" type="password"
                                               id="inputName"
                                               class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary float-right">Đổi mật khẩu
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
