<?php

use Illuminate\Http\Request;
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

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout')->name('logout');
 
Route::middleware('auth')->group(function () {
    Route::get('', 'HomeController@index')->name('index');

    Route::group(['prefix' => 'phieumua', 'as' => 'phieumua.'], function () {
        Route::middleware('acl:phieumua-list')->group(function () {
            Route::get('danhsach', 'PhieuMuaController@index')->name('index');
            Route::get('timkiem', 'PhieuMuaController@timKiemPhieuMua')->name('search');
        });
        Route::middleware('acl:phieumua-create')->group(function () {
            Route::get('them', 'PhieuMuaController@showCreate')->name('create');
            Route::post('them', 'PhieuMuaController@create');
        });
        
        Route::middleware('acl:phieudenghi-delete')->group(function () {
            Route::delete('xoa/{ID}', 'PhieuMuaController@delete')->name('delete');
        });
        Route::middleware('acl:phieudenghi-detail')->group(function () {
            Route::get('chitiet/{ID?}', 'PhieuMuaController@detail')->name('detail');
        });
        Route::middleware('acl:phieudenghi-edit')->group(function () {
            Route::get('sua/{ID?}', 'PhieuMuaController@showEdit')->name('edit');
            Route::put('sua/{ID?}', 'PhieuMuaController@edit');
        });
        Route::middleware('acl:phieudenghi-hoanthanh')->group(function () {
            Route::put('hoanthanh/{ID?}', 'PhieuMuaController@hoanThanh')->name('hoanThanh');
        });
    });

    Route::group(['prefix' => 'xetduyet', 'as' => 'xetduyet.'], function () {
        Route::middleware('acl:phieudenghi-xetduyet')->group(function () {
            Route::get('danhsach', 'XetDuyetController@index')->name('index');
            Route::get('chitiet/{ID?}', 'XetDuyetController@detail')->name('detail');
            Route::put('phieudenghi/{ID?}', 'XetDuyetController@xetDuyet')->name('confirm');
            Route::put('ghichu/{ID?}', 'XetDuyetController@ghiChu')->name('ghiChu');
        });
    });

    Route::group(['prefix' => 'phieubangiao', 'as' => 'phieubangiao.'], function () {
        Route::middleware('acl:phieubangiao-list')->group(function () {
            Route::get('danhsach', 'PhieuBanGiaoController@index')->name('index');
        });
        Route::middleware('acl:phieubangiao-create')->group(function () {
            Route::get('them/{ID?}', 'PhieuBanGiaoController@showCreateForm')->name('create');
            Route::post('them/{ID?}', 'PhieuBanGiaoController@create');
        });
        Route::middleware('acl:phieubangiao-xacnhan')->group(function () {
            Route::put('xacnhan/{ID?}','PhieuBanGiaoController@xacNhan')->name('xacNhan');
        });
        Route::middleware('acl:phieubangiao-detail')->group(function () {
            Route::get('chitiet/{ID?}', 'PhieuBanGiaoController@detail')->name('detail');
        });
        Route::middleware('acl:phieubangiao-edit')->group(function () {
            Route::post('sua/{ID?}', 'PhieuBanGiaoController@update')->name('update');
        });
        Route::middleware('acl:phieubangiao-delete')->group(function () {
            Route::delete('xoa/{ID}', 'PhieuBanGiaoController@delete')->name('delete');
        });
    });

    Route::group(['prefix' => 'vattu', 'as' => 'vattu.'], function () {
        Route::middleware('acl:vattu-list')->group(function () {
            Route::get('danhsach', 'VatTuController@index')->name('index');
        });
        Route::middleware('acl:vattu-create')->group(function () {
            Route::get('them', 'VatTuController@showCreateForm')->name('create');
            Route::post('bangiao', 'VatTuController@create');
        });
        Route::get('chitiet/{ID?}', 'VatTuController@detail')->name('detail');
    });

    Route::group(['prefix' => 'nguoidung', 'as' => 'nguoidung.'], function () {
        Route::middleware('acl:nguoidung-list')->group(function () {
            Route::get('danhsach', 'NguoiDungController@index')->name('index');
        });
    });
    Route::get('thongke', 'ThongKeController@index')->name('thongke');

    Route::group(['prefix' => 'trangcanhan', 'as' => 'profile.'], function(){
        Route::get('', 'NguoiDungController@profile')->name('index');
        Route::put('thaydoithongtin', 'NguoiDungController@updateInfo')->name('updateInfo');
        Route::put('thaydoimatkhan', 'NguoiDungController@updatePassword')->name('updatePassword');
    });
});

Route::group(['prefix' => 'api'],function(){
    Route::post('vanphongpham','VatTuController@listVPP')->name('vpp');
    Route::post('chitiethanmuc','HanMucController@getHanMuc')->name('cthanmuc');
});

