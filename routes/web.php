<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', 'Admin\LoginController@getLogin')->name('login');
Route::get('/login', 'Admin\LoginController@getLogin')->name('login');
Route::post('/login', 'Admin\LoginController@login')->name('login');

Route::group(['middleware' => 'checklogin'], function () {

    Route::get('/home', 'Admin\HomeController@home')->name('home');

    Route::get('/logout', 'Admin\LoginController@logout')->name('logout');

    Route::get('/students', ['as' => 'chamdiemrenluyen.students', 'uses' => 'Admin\GiaoVienController@showStudent']);
    Route::get('/admin/product/add', ['as' => 'admin.product.add', 'uses' => 'Admin\ProductController@addProduct']);
    Route::post('/admin/product/add', ['as' => 'admin.product.save', 'uses' => 'Admin\ProductController@addProductPost']);
    Route::get('/admin/product/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Admin\ProductController@edit']);
    Route::post('/admin/product/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'Admin\ProductController@update']);
    Route::get('/admin/product/destroy/{id}', ['as' => 'admin.product.getDestroy', 'uses' => 'Admin\ProductController@destroy']);
    Route::get('/admin/product/{id}', ['as' => 'admin.product', 'uses' => 'Admin\ProductController@cate_product']);
    Route::get('/admin/product/active/{id}', ['as' => 'admin.product.active', 'uses' => 'Admin\ProductController@active']);


    Route::get('/score', ['as' => 'chamdiemrenluyen.score', 'uses' => 'Admin\ScoreController@index']);
    Route::post('/score/update/{maND}', ['as' => 'chamdiemrenluyen.score.update', 'uses' => 'Admin\ScoreController@updateScore']);
    Route::get('/admin/category/add', ['as' => 'admin.category.add', 'uses' => 'Admin\CateController@addCate']);
    Route::post('/admin/category/add', ['as' => 'admin.category.save', 'uses' => 'Admin\CateController@addCatePost']);
    Route::get('/admin/category/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Admin\CateController@edit']);
    Route::post('/admin/category/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Admin\CateController@update']);
    Route::get('/admin/category/destroy/{id}', ['as' => 'admin.category.getDestroy', 'uses' => 'Admin\CateController@destroy']);

    Route::get('/profile', ['as' => 'chamdiemrenluyen.profile', 'uses' => 'Admin\StudentController@index']);
    Route::get('/TKB', ['as' => 'chamdiemrenluyen.TKB', 'uses' => 'Admin\StudentController@crawlTKB']);
    Route::post('/profile/update{id}', ['as' => 'chamdiemrenluyen.profile.update', 'uses' => 'Admin\StudentController@updateProfile']);
    Route::post('/profile/changePassword{id}', ['as' => 'chamdiemrenluyen.profile.changePassword', 'uses' => 'Admin\StudentController@changePassword']);
    Route::get('/admin/brand/add', ['as' => 'admin.brand.add', 'uses' => 'Admin\BrandController@addBrand']);
    Route::post('/admin/brand/add', ['as' => 'admin.brand.save', 'uses' => 'Admin\BrandController@addBrandPost']);
    Route::get('/admin/brand/edit/{id}', ['as' => 'admin.brand.edit', 'uses' => 'Admin\BrandController@edit']);
    Route::post('/admin/brand/edit/{id}', ['as' => 'admin.brand.edit', 'uses' => 'Admin\BrandController@update']);
    Route::get('/admin/brand/destroy/{id}', ['as' => 'admin.brand.getDestroy', 'uses' => 'Admin\BrandController@destroy']);

    //khuyến mãi
    Route::get('/admin/discount', ['as' => 'admin.discount.index', 'uses' => 'Admin\DiscountController@index']);
    Route::get('/admin/discount/add', ['as' => 'admin.discount.add', 'uses' => 'Admin\DiscountController@addDiscount']);
    Route::post('/admin/discount/add', ['as' => 'admin.discount.save', 'uses' => 'Admin\DiscountController@addDiscountPost']);
    Route::get('/admin/discount/edit/{id}', ['as' => 'admin.discount.edit', 'uses' => 'Admin\DiscountController@edit']);
    Route::post('/admin/discount/edit/{id}', ['as' => 'admin.discount.edit', 'uses' => 'Admin\DiscountController@update']);
    Route::get('/admin/discount/destroy/{id}', ['as' => 'admin.discount.getDestroy', 'uses' => 'Admin\DiscountController@destroy']);

    Route::get('/admin/order', ['as' => 'admin.order.index', 'uses' => 'Admin\OrderController@index']);
    Route::get('/admin/order/add', ['as' => 'admin.order.add', 'uses' => 'Admin\OrderController@addOrder']);
//    Route::post('/admin/order/add', ['as' => 'admin.order.save', 'uses' => 'Admin\OrderController@addOrderPost']);
    Route::get('/admin/order/detail/{id}', ['as' => 'admin.order.detail', 'uses' => 'Admin\OrderController@detail']);
    Route::get('/admin/order/edit/{id}', ['as' => 'admin.order.edit', 'uses' => 'Admin\OrderController@edit']);
    Route::post('/admin/order/edit/{id}', ['as' => 'admin.order.edit', 'uses' => 'Admin\OrderController@update']);
//    Route::get('/admin/order/detail/destroy/{id}', ['as' => 'admin.order.getDestroy', 'uses' => 'Admin\OrderController@destroy']);
    Route::get('/admin/order/action/{id}', ['as' => 'admin.order.action', 'uses' => 'Admin\OrderController@action']);
    Route::get('/admin/order/cancel/{id}', ['as' => 'admin.order.cancel', 'uses' => 'Admin\OrderController@cancel']);
    Route::get('/admin/order/returns/{id}', ['as' => 'admin.order.returns', 'uses' => 'Admin\OrderController@returns']);
    Route::get('/admin/order/del_product/{MaSP}/{MaHD}', ['as' => 'admin.order.getDestroy', 'uses' => 'Admin\OrderController@destroy']);
    Route::get('/admin/order/detail/{MaSP}/{MaHD}/{sl}', 'Admin\OrderController@change_sl');

//
    Route::get('/admin/user', ['as' => 'admin.user.index', 'uses' => 'Admin\UserController@index']);
    Route::get('/admin/user/add', ['as' => 'admin.user.add', 'uses' => 'Admin\UserController@addUser']);
    Route::post('/admin/user/add', ['as' => 'admin.user.save', 'uses' => 'Admin\UserController@addUserPost']);
    Route::get('/admin/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Admin\UserController@edit']);
    Route::post('/admin/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Admin\UserController@update']);
    Route::get('/admin/user/destroy/{id}', ['as' => 'admin.user.getDestroy', 'uses' => 'Admin\UserController@destroy']);


    //Giáo viên
    Route::get('/viewScore', ['as' => 'chamdiemrenluyen.viewScore', 'uses' => 'Admin\GiaoVienController@viewScore']);
    Route::post('/viewScore', ['as' => 'chamdiemrenluyen.viewScore.hocki', 'uses' => 'Admin\GiaoVienController@viewScoreHocKi']);
    Route::get('/viewScore/duyet/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.duyet', 'uses' => 'Admin\GiaoVienController@duyetDRL']);
    Route::get('/viewScore/duyettatca', ['as' => 'chamdiemrenluyen.viewScore.duyettatca', 'uses' => 'Admin\GiaoVienController@duyetDRLtatca']);
    Route::get('/viewScore/GVcham/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.chamlai', 'uses' => 'Admin\GiaoVienController@viewGVcham']);
    Route::post('/viewScore/GVcham/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.chamlai.update', 'uses' => 'Admin\GiaoVienController@updateGVcham']);
    Route::get('/viewScore/khoaduyet/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.khoaduyet', 'uses' => 'Admin\GiaoVienController@khoaduyetDRL']);
    Route::get('/lecTKB', ['as' => 'chamdiemrenluyen.lecTKB', 'uses' => 'Admin\GiaoVienController@lec_crawlTKB']);


    //khoa
    Route::get('/qlsv', ['as' => 'chamdiemrenluyen.qlsv', 'uses' => 'Admin\KhoaController@qlsv']);
    Route::get('/qlsv/search', ['as' => 'chamdiemrenluyen.qlsv.search', 'uses' => 'Admin\KhoaController@searchStudent']);
    Route::get('/lop', ['as' => 'chamdiemrenluyen.lop', 'uses' => 'Admin\KhoaController@lop']);
    Route::get('/giaovien', ['as' => 'chamdiemrenluyen.giaovien', 'uses' => 'Admin\KhoaController@giaovien']);
    Route::get('/giaovien/add', ['as' => 'chamdiemrenluyen.giaovien.add', 'uses' => 'Admin\KhoaController@addgiaovien']);
    Route::post('/giaovien/add', ['as' => 'chamdiemrenluyen.giaovien.post', 'uses' => 'Admin\KhoaController@postgiaovien']);
    Route::get('/giaovien/del/{id}', ['as' => 'chamdiemrenluyen.giaovien.del', 'uses' => 'Admin\KhoaController@del']);
    Route::get('/giaovien/edit/{id}', ['as' => 'chamdiemrenluyen.giaovien.edit', 'uses' => 'Admin\KhoaController@edit']);

    //admin
    Route::get('/khoa', ['as' => 'chamdiemrenluyen.khoa', 'uses' => 'Admin\AdminController@index']);
    Route::post('/khoa/add', ['as' => 'chamdiemrenluyen.khoa.add', 'uses' => 'Admin\AdminController@addKhoa']);
    Route::get('/khoa/del/{id}', ['as' => 'chamdiemrenluyen.khoa.del', 'uses' => 'Admin\AdminController@del']);
    Route::get('/user/sinhvien', ['as' => 'chamdiemrenluyen.khoa.user.sinhvien', 'uses' => 'Admin\AdminController@sinhvien']);
    Route::get('/user/giaovien', ['as' => 'chamdiemrenluyen.khoa.user.giaovien', 'uses' => 'Admin\AdminController@giaovien']);
    Route::get('/user/bqlkhoa', ['as' => 'chamdiemrenluyen.khoa.user.bqlkhoa', 'uses' => 'Admin\AdminController@bqlkhoa']);
    Route::get('/user/bqlkhoa/add', ['as' => 'chamdiemrenluyen.khoa.user.bqlkhoa.add', 'uses' => 'Admin\AdminController@addbqlkhoa']);
    Route::post('/user/bqlkhoa/add', ['as' => 'chamdiemrenluyen.khoa.user.bqlkhoa.post', 'uses' => 'Admin\AdminController@postbqlkhoa']);
    Route::get('/user/admin', ['as' => 'chamdiemrenluyen.khoa.user.admin', 'uses' => 'Admin\AdminController@admin']);
            //nhap file excel sv
    Route::post('/user/sinhvien/nhapsv_excel', ['as' => 'chamdiemrenluyen.user.sinhvien.nhap_excel', 'uses' => 'Admin\AdminController@nhapsv_excel']);
            // chức năng thông báo
    Route::get('/quanlithongbao', ['as' => 'chamdiemrenluyen.thongbao', 'uses' => 'Admin\AdminController@thongbao']);
    Route::post('/quanlithongbao/update/{id}', ['as' => 'chamdiemrenluyen.thongbao.update', 'uses' => 'Admin\AdminController@updateTB']);
    Route::get('/quanlithongbao/del/{id}', ['as' => 'chamdiemrenluyen.thongbao.del', 'uses' => 'Admin\AdminController@delTB']);
    Route::post('/quanlithongbao.create', ['as' => 'chamdiemrenluyen.thongbao.create', 'uses' => 'Admin\AdminController@createTB']);


});









