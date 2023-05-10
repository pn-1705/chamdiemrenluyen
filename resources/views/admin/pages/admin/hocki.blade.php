@extends('admin.layout', ['title' => 'Học kì'])
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="font-weight-bold text-uppercase">danh sách học kì</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Học kì</li>
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
                <div class="card col-md-12">
                    <form action="{{ route("chamdiemrenluyen.hocki.add") }}" method="POST">
                        @csrf
                        <div class="">
                            <div>
                                <div class="font-weight-bold card-header">TẠO HỌC KÌ</div>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="inputName">Mã HK</label>
                                            <input value="" name="id" type="text"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Năm</label>
                                            <input value="" name="nam" type="number"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                    class="text-uppercase btn btn-outline-primary float-left">thêm
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="inputName">SV chấm điểm</label>
                                            <input value="" name="tgSVBD" type="date"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">TTL chấm điểm</label>
                                            <input value="" name="tgTTLBD" type="date"
                                                   id="inputName" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="inputName">Khoa chấm điểm</label>
                                            <input value="" name="tgKBD" type="date"
                                                   id="inputName" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName">Thời gian công bố</label>
                                            <input value="" name="tgKT" type="date"
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
                            <th colspan="7">
                                <div class="">DANH SÁCH HỌC KÌ
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>Mã HK</th>
                            <th>Năm</th>
                            <th>SV chấm điểm</th>
                            <th>TTL chấm điểm</th>
                            <th>Khoa chấm điểm</th>
                            <th>Công bố</th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbProduct">
                        <?php $i = 1;
                        ?>
                        @foreach($listHK as $key => $value)
                            <form action="{{ route("chamdiemrenluyen.hocki.update", $value -> id) }}"
                                  method="POST">
                                @csrf
                                <tr>
                                    <td>
                                        {{ $value -> id }}
                                    </td>
                                    <td><input value="{{ $value -> nam }}" name="nam" type="number"
                                               id="inputName" class="form-control w-75"></td>
                                    <td><input value="{{ $value -> tgSVBD }}" name="tgSVBD" type="date"
                                               id="inputName" class="form-control w-75"></td>
                                    <td><input value="{{ $value -> tgTTLBD }}" name="tgTTLBD" type="date"
                                               id="inputName" class="form-control w-75"></td>
                                    <td><input value="{{ $value -> tgKBD }}" name="tgKBD" type="date"
                                               id="inputName" class="form-control w-75"></td>
                                    <td><input value="{{ $value -> tgKT }}" name="tgKT" type="date"
                                               id="inputName" class="form-control w-75"></td>


                                    <td class="project-actions text-right">
                                        <button class="btn btn-primary btn-sm" type="submit">
                                            <i class="fas fa-trash">
                                            </i>
                                            Update
                                        </button>
                                        <a class="btn btn-danger btn-sm"
                                           href="{{ route("chamdiemrenluyen.hocki.del",  $value -> id ) }}">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
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

        </div>
        <!-- /.card -->
    </section>
@endsection
