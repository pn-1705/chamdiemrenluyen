<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <a href="http://localhost/phonestore/admin/dashboard" class="text-light brand-link text-center">
        {{--        <img src="{{asset('public/backend/img/logo.png')}}" alt="MONA" class="brand-image">--}}
        <P class="text-center animation__wobble font-weight-light">HỆ THỐNG CHẤM <BR>ĐIỂM RÈN LUYỆN</P>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    <?php
                                    $ten = Session::get('ten');
                                    echo $ten;
                                    ?>
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <i class="fas fa-key nav-icon"></i>
                                        <p><?php
                                            $q = Session::get('Quyen_id');
                                            if ($q == 2) {
                                                echo 'Giáo viên';
                                            } else {
                                                if ($q == 3) {
                                                    echo 'Sinh viên';
                                                } else {
                                                    echo 'Adminítrator';
                                                }
                                            }
                                            ?>
                                        </p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link">
                                        <i class="fas fa-sign-in-alt nav-icon"></i>
                                        <p>Đăng xuất</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Tìm kiếm..."
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('home')}}"
                       class="nav-link {{ Route::is('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p class="text-uppercase">
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-calendar-times    "></i>
                        <p class="text-uppercase">
                            Thời khóa biểu
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>


                <li class="nav-item" {{ Session::get('Quyen_id') == 2 ? '' : 'hidden' }}>
                    <a href="{{ route('chamdiemrenluyen.students')}}"
                       class="nav-link {{ Route::is('chamdiemrenluyen.students') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            SINH VIÊN
                            <span class="right badge badge-primary">{{Session::get('lopID')}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item" {{ Session::get('Quyen_id') == 1 ? '' : 'hidden' }}>
                    <a href="{{ route('chamdiemrenluyen.qlsv')}}"
                       class="nav-link {{ Route::is('chamdiemrenluyen.qlsv') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>
                            SINH VIÊN
                            <span class="right badge badge-primary">{{Session::get('lopID')}}</span>
                        </p>
                    </a>
                </li>
                <li class="nav-item" {{ Session::get('Quyen_id') == 3 ? '' : 'hidden' }}>
                    <a href="{{ route('chamdiemrenluyen.score') }}"
                       class="nav-link {{ Route::is('chamdiemrenluyen.score') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p class="text-uppercase">
                            {{--                            <span class="badge badge-info right">--}}
                            {{--                                    {{DB::table('danhmuc')->count()}}--}}
                            {{--                                </span>--}}
                            ĐIỂM RÈN LUYỆN
                        </p>
                    </a>
                </li>
                <li class="nav-item" {{ Session::get('Quyen_id') == 2 || Session::get('Quyen_id') == 1 ? '' : 'hidden' }}>
                    <a href="{{ route('chamdiemrenluyen.viewScore') }}"
                       class="nav-link {{ Route::is('chamdiemrenluyen.viewScore') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p class="text-uppercase">
                            {{--                            <span class="badge badge-info right">--}}
                            {{--                                    {{DB::table('danhmuc')->count()}}--}}
                            {{--                                </span>--}}
                            ĐIỂM RÈN LUYỆN
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('chamdiemrenluyen.profile') }}"
                       class="nav-link {{ Route::is('chamdiemrenluyen.profile') ? 'active' : '' }}">
                        <i class="nav-icon far fa-id-card"></i>
                        <p class="text-uppercase">
                            {{--                            <span class="badge badge-info right">--}}
                            {{--                                    {{DB::table('loaisanpham')->count()}}--}}
                            {{--                                </span>--}}
                            Thông tin cá nhân
                        </p>
                    </a>
                </li>
                                <li class="nav-item" {{ Session::get('Quyen_id') == 0 ? '' : 'hidden' }}>
                                    <a href="{{ route('chamdiemrenluyen.khoa') }}"
                                       class="nav-link {{ Route::is('chamdiemrenluyen.khoa') ? 'active' : '' }}">
                                        <i class="nav-icon far fa-id-card"></i>
                                        <p class="text-uppercase">
                                                                        <span class="badge badge-info right">
                                                                            </span>
                                            Khoa
                                        </p>
                                    </a>
                                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p class="text-uppercase">
                                    <?php
                                    $ten = Session::get('ten');
                                    echo $ten . " (";

                                    $q = Session::get('Quyen_id');
                                    if ($q == 2) {
                                        echo 'GVCN';
                                    } else {
                                        if ($q == 3) {
                                            echo 'Sinh viên';
                                        } else {
                                            if ($q == 1){
                                                echo 'HĐK';
                                            }
                                            else{
                                                echo 'ADMIN';
                                            }
                                        }
                                    }
                                    echo ")";

                                    ?>


                                </p>
                                <i class="fas fa-angle-left right"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('logout') }}" class="nav-link">
                                        <i class="fas fa-sign-in-alt nav-icon"></i>
                                        <p>Đăng xuất</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
