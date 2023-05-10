@extends('admin.layout', ['title' => 'Khoa'])
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
                    <h1 class="font-weight-bold text-uppercase">khoa - lớp</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Khoa</li>
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
                            <th colspan="4">
                                <div class="">DANH SÁCH KHOA
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>STT</th>
                            <th>Khoa</th>
                            <th>Trưởng khoa</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($listKhoa as $key => $value)

                            <tr>
                                <td><?php echo $i++;
                                    ?></td>
                                <td>{{ $value -> tenKhoa }}</td>
                                <td>@if(isset($value -> truongkhoa))
                                        {{$value -> hocham.'. '. $value -> ten}}
                                    @endif</td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-primary btn-sm"
                                       href="{{ route("chamdiemrenluyen.khoa.class",  $value -> maKhoa ) }}">
                                        <i class="fas fa-trash">
                                        </i>
                                        View
                                    </a><a class="btn btn-danger btn-sm"
                                           href="{{ route("chamdiemrenluyen.khoa.del",  $value -> maKhoa ) }}">
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

                <div class="card card-body">
                    <form action="{{ route("chamdiemrenluyen.khoa.add") }}" method="POST">
                        @csrf
                        <div class="">
                            <div>
                                <div class="font-weight-bold card-header">THÊM KHOA</div>
                                @if(session('thieutruong'))
                                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-danger">
                                        {{session('thieutruong')}}
                                    </div>
                                @endif
                                @if(session('thanhcong'))
                                    <div style="margin: 0px; padding: 0.5rem 1.25rem" class="alert alert-success">
                                        {{session('thanhcong')}}
                                    </div>
                                @endif
                                <div class="card-body d-flex">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label for="inputName">Mã khoa</label>
                                            <input value="" name="makhoa" type="text"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Tên khoa</label>
                                            <input value="" name="tenkhoa" type="text"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Trưởng khoa</label>
                                            <select class="form-control" name="truongkhoa" id="inputName">
                                                <option value="null">-Chọn-</option>
                                                @foreach($listGiaoVien as $key => $value)
                                                    <option
                                                        value="{{$value ->  maGV}}"> {{$value -> hocham.'. '. $value -> ten}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="text-uppercase btn btn-outline-primary float-right">thêm
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

                <!-- /.card-body -->
            </div>
            <div class="col-md-6">
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
                            <th colspan="5">
                                <div class="">
                                    @if(isset($nameKhoa)!= null)
                                        Khoa {{$nameKhoa->tenKhoa}}
                                    @else
                                        Tất cả
                                    @endif
                                </div>
                            </th>
                        </tr>
                        </thead>

                        @if($listClass == null)
                            <p>Không tìm thấy lớp nào !</p>
                        @else
                            <tr>
                                <th>STT</th>
                                <th>Lớp</th>
                                <th>Ngành</th>
                                <th>GVCN</th>
                                <th>
                                </th>
                            </tr>
                            <tbody id="tbProduct">
                            <?php $i = 1;
                            ?>

                            @foreach($listClass as $key => $value)

                                <tr>
                                    <td><?php echo $i++;
                                        ?></td>
                                    <td>{{ $value -> maLop }}</td>
                                    <td>{{$value -> nganh}}</td>
                                    <td>{{$value -> ten}}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-danger btn-sm"
                                           href="{{ route("chamdiemrenluyen.khoa.del",  $value -> maLop ) }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        @endif

                    </table>
                </div>
                <!-- /.card-body -->
            </div>

        </div>
        <!-- /.card -->
    </section>
@endsection
