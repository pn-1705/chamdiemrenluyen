@extends('admin.layout', ['title' => 'Thời khóa biểu'])
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
                    <h1 class="font-weight-bold text-uppercase">thời khóa biểu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Thời khóa biểu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="row">
            <div class="col-md-12">
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
                <div class="card card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th>Lớp</th>
                            <th>Môn học</th>
                            <th>Phòng</th>
                            <th>Thứ</th>
                            <th>Từ tiết</th>
                            <th>Đến tiết</th>
                            <th>Ngày hiệu lực</th>
                            <th>Ghi chú</th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($tkbData as $value)
                            @if($value != null)
                                <tr>
                                    @if(substr($value[0], 0, 3) == 222 )

                                        <td>{{ $value[0] }}</td>
                                        <td>{{ $value[1] }}</td>
                                        <td>{{ $value[2] }}</td>
                                        <td>{{ $value[3] }}</td>
                                        <td>{{ $value[4] }}</td>
                                        <td>{{ $value[5] }}</td>
                                        <td>{{ $value[6] }}</td>
                                        <td>{{ $value[7] }}</td>
                                    @endif
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            {{--            <div class="col-md-5">--}}
            {{--                <form action="{{ route("chamdiemrenluyen.khoa.add") }}" method="POST">--}}
            {{--                    @csrf--}}
            {{--                    <div class="card card-primary">--}}
            {{--                        <div>--}}
            {{--                            <div class="font-weight-bold card-header">THÊM KHOA</div>--}}
            {{--                            @if(session('thieutruong'))--}}
            {{--                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">--}}
            {{--                                    {{session('thieutruong')}}--}}
            {{--                                </div>--}}
            {{--                            @endif--}}
            {{--                            @if(session('thanhcong'))--}}
            {{--                                <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-success">--}}
            {{--                                    {{session('thanhcong')}}--}}
            {{--                                </div>--}}
            {{--                            @endif--}}
            {{--                            <div class="card-body d-flex">--}}
            {{--                                <div class="col-md-12">--}}

            {{--                                    <div class="form-group">--}}
            {{--                                        <label for="inputName">Mã khoa</label>--}}
            {{--                                        <input value="" name="makhoa" type="text"--}}
            {{--                                               id="inputName" class="form-control">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label for="inputName">Tên khoa</label>--}}
            {{--                                        <input value="" name="tenkhoa" type="text"--}}
            {{--                                               id="inputName" class="form-control">--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <label for="inputName">Trưởng khoa</label>--}}
            {{--                                        <select class="form-control" name="truongkhoa" id="inputName">--}}
            {{--                                            <option value="null">-Chọn-</option>--}}
            {{--                                            @foreach($listGiaoVien as $key => $value)--}}
            {{--                                                <option value="{{$value ->  maGV}}"> {{$value -> hocham.'. '. $value -> ten}}</option>--}}
            {{--                                            @endforeach--}}
            {{--                                        </select>--}}
            {{--                                    </div>--}}
            {{--                                    <div class="form-group">--}}
            {{--                                        <button type="submit"--}}
            {{--                                                class="text-uppercase btn btn-outline-primary float-right">thêm--}}
            {{--                                        </button>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <!-- /.card-body -->--}}
            {{--                        </div>--}}
            {{--                        <!-- /.card -->--}}
            {{--                    </div>--}}
            {{--                </form>--}}
            {{--                <!-- /.card-body -->--}}
            {{--            </div>--}}
        </div>
        <!-- /.card -->
    </section>
@endsection
