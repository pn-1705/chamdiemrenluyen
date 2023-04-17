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
    Route::post('/viewScore/hocki', ['as' => 'chamdiemrenluyen.viewScore.hocki', 'uses' => 'Admin\GiaoVienController@viewScoreHocKi']);
    Route::get('/viewScore/duyet/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.duyet', 'uses' => 'Admin\GiaoVienController@duyetDRL']);
    Route::get('/viewScore/khoaduyet/{maSV}', ['as' => 'chamdiemrenluyen.viewScore.khoaduyet', 'uses' => 'Admin\GiaoVienController@khoaduyetDRL']);


    //khoa
    Route::get('/qlsv', ['as' => 'chamdiemrenluyen.qlsv', 'uses' => 'Admin\KhoaController@qlsv']);

});









