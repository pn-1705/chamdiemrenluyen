<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <LINK REL="SHORTCUT ICON" HREF="{{asset('public//imgs/Logo_Đại_học_Sư_phạm_Kỹ_thuật_Đà_Nẵng.png')}}">
    <title>Đăng nhập | Chấm điểm rèn luyện</title>
    @include('admin.elements.header-libs')
</head>
<body class="hold-transition login-page">
<div class="login-box">
{{--    form login--}}
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div style="display: flex; justify-content: center">
                <img style="display: flex; justify-content: center" WIDTH="80px" src="public/imgs/Logo_Đại_học_Sư_phạm_Kỹ_thuật_Đà_Nẵng.png" alt="">
                <p style="font-weight: bold; margin: 20px; text-align: center">HỆ THỐNG CHẤM ĐIỂM RÈN LUYỆN</p>
            </div>
            <div class="error">
                <ul>
                    @if ($errors -> any())
                        {{--                    {{ dd($errors) }}--}}
                        @foreach($errors->all() as $key => $value)
                            <li class="text-danger">{{ $value }}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <?php
            $message = Session::get('message');
            if ($message) {
                echo '<span class="text-danger">' . $message . '</span>';
                Session::put('message', null);
            }
            ?>
            <form action="{{ route("login") }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" name="maND" class="form-control" placeholder="Mã SV/ Mã GV" value="{{ old('maND') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row" style="justify-content: space-around">
{{--                    <div class="col-8">--}}
{{--                        <div class="icheck-primary">--}}
{{--                            <input type="checkbox" id="remember">--}}
{{--                            <label for="remember">--}}
{{--                                Remember Me--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <!-- /.col -->
                    <div>
                        <button type="submit" class="font-weight-bold btn btn-primary btn-block">ĐĂNG NHẬP</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

@include('admin.elements.footer-libs')
<script>
    @if ($errors -> any())
        toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 100;
    toastr.options.closeEasing = 'swing';
    toastr.options.timeOut = 1000; // How long the toast will display without user interaction
    toastr.options.extendedTimeOut = 60; // How long the toast will display after a user hovers over it
    toastr.error("Login Fail","Fail");
    @endif
</script>
</body>
</html>
