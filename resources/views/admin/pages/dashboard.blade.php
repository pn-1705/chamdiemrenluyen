@extends('admin.layout', ['title' => 'Home'])
@section('content')

    @include('admin.elements.logo-load')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Trang chủ</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Chấm điểm rèn luyện</a></li>
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php $role = Session::get('Quyen_id'); ?>
    <section {{$role == 2 ? '' : 'hidden'}} class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <p>Xin chào giảng viên {{Session::get('ten')}}</p>
                        <p class="font-weight-bold   text-uppercase">hệ thống chấm điểm rèn luyện<br><a href="#">trường
                                đại học sư phạm kỹ thuật - đại học đà nẵng</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section {{$role == 3 ? '' : 'hidden'}} class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <p>Xin chào sinh viên {{Session::get('ten')}}</p>
                        <p class="font-weight-bold   text-uppercase">hệ thống chấm điểm rèn luyện<br><a href="#">trường
                                đại học sư phạm kỹ thuật - đại học đà nẵng</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="font-weight-bold card-header">THÔNG BÁO</div>

                    <div class="card-body">
                        <table class="table-bordered">
                            @foreach($listAlert as $v)
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            <p class="font-weight-bold text-uppercase">{{$v->tieude}}</p>
                                            <i class="text-right">{{$v->ngayTB}}</i>
                                        </div>
                                        <p>{{$v->noidung}}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
