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
    <section {{$role == 1 ? '' : 'hidden'}} class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Doanh thu</span>
                            <span class="info-box-number">
{{--                            {{number_format(DB::table('hoadon')->sum('TongTien'),0,',','.')}}--}}
                  <small>VNĐ</small>
                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-chart-pie"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tỷ lệ ĐHĐG</span>
                            <span class="info-box-number">
{{--                                    {{(DB::table('hoadon')->where('TrangThai', '3')->count()) / (DB::table('hoadon')->count())*100 }}--}}
                                <small>%</small>
                                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Đơn hàng</span>
                            <span class="info-box-number">
{{--                                    {{DB::table('hoadon')->count()}}--}}
                                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Khách hàng</span>
                            <span class="info-box-number">
{{--                                    {{DB::table('nguoidung')->where('Quyen_id', '1')->count()}}--}}
                                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>
    <section {{$role == 2 ? '' : 'hidden'}} class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <p>Xin chào giảng viên {{Session::get('ten')}}</p>
                        <p class="font-weight-bold   text-uppercase">hệ thống chấm điểm rèn luyện<br><a href="#">trường đại học sư phạm kỹ thuật - đại học đà nẵng</a> </p>
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
    <!-- /.content -->
@endsection
