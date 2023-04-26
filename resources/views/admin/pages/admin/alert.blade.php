@extends('admin.layout', ['title' => 'Quản lí thông báo'])
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
                    <h1 class="font-weight-bold text-uppercase">Quản lí thông báo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">QLTB</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="col-md-12">
                <!-- /.card-body -->
                <form action="{{ route("chamdiemrenluyen.thongbao.create") }}" method="POST">
                    @csrf
                    <div>
                        <div>
                            @if(session('thieutruong'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                                    {{session('thieutruong')}}
                                </div>
                            @endif
                            @if(session('sucess'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-success">
                                    {{session('sucess')}}
                                </div>
                            @endif
                            @if(session('tontai'))
                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-warning">
                                    {{session('tontai')}}
                                </div>
                            @endif
                            <div class="font-weight-bold card-header">TẠO THÔNG BÁO</div>

                            <div class="card-body d-flex">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label for="inputName">Tiêu đề:</label>
                                        <input value="" name="tieude" type="text"
                                               id="inputName" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName">Nội dung:</label>
                                        <textarea class="form-control" name="noidung" type="text">
                                        </textarea>
                                    </div>
                                    <div class="form-group d-flex">
                                        <div class="col-md-6">
                                            <label for="inputName1">Ngày gửi thông báo:</label>
                                            <input name="ngayTB" id="inputName1" type="date" class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputName">Đối tượng nhận thông báo:</label>
                                            <select class="form-control" name="nguoinhan" id="inputName">
                                                <option value="0">Tất cả</option>
                                                <option value="1">BCN Khoa</option>
                                                <option value="2">Giáo Viên</option>
                                                <option value="3">Sinh Viên</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                                class="text-uppercase btn btn-success float-right">Tạo
                                        </button>


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


        {{--        DANH sách thông báo--}}
        <div class="card">
            <div class="col-md-12">
                <!-- /.card-body -->
                <div>
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
                        <div class="font-weight-bold card-header">TẤT CẢ THÔNG BÁO</div>

                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th>Ngày gửi TB</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Người nhận TB</th>
                                    <th class="text-right">Hành động</th>
                                </tr>
                                </thead>
                                <tbody id="tbProduct">
                                @foreach($listAlert as $key => $value)

                                    <form action="{{ route("chamdiemrenluyen.thongbao.update", $value -> maTB) }}" method="POST">
                                        @csrf
                                        <tr>
                                            <td>
                                                <input value="{{ $value -> ngayTB }}" name="ngayTB" type="date"
                                                       id="inputName" class="form-control w-75">
                                            </td>
                                            <td class="font-weight-bold">
                                                <textarea rows="10" name="tieude" type="text"
                                                          id="inputName" class="form-control">
                                                    {{ $value -> tieude}}
                                                </textarea>
                                            </td>
                                            <td>
                                                <textarea cols="50" rows="10" name="noidung" type="text"
                                                          id="inputName" class="form-control">
                                                    {{ $value -> noidung}}
                                                </textarea>
                                            </td>
                                            <td>
                                                <select class="form-control" name="nguoinhan" id="inputName">
                                                    <option {{$value -> nguoinhan ==0 ? 'selected' : ''}} value="0">Tất
                                                        cả
                                                    </option>
                                                    <option {{$value -> nguoinhan ==1 ? 'selected' : ''}} value="1">BCN
                                                        Khoa
                                                    </option>
                                                    <option {{$value -> nguoinhan ==2 ? 'selected' : ''}} value="2">Giáo
                                                        Viên
                                                    </option>
                                                    <option {{$value -> nguoinhan ==3 ? 'selected' : ''}} value="3">Sinh
                                                        Viên
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="project-actions text-right ">
                                                <button class="btn btn-primary btn-sm" type="submit">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Update
                                                </button>
                                                <a class="btn btn-danger btn-sm delete" onclick="confirmDel()"
                                                   href="{{ route("chamdiemrenluyen.thongbao.del",  $value -> maTB ) }}">
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    Del
                                                </a>
                                            </td>
                                        </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
