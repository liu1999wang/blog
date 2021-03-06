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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','Login@index');//登录页面
Route::group(['prefix'=>'login'],function (){
Route::get('index','Login@index');//登录页面
Route::post('store','Login@store');//登录验证
});

Route::group(['prefix'=>'index','middleware'=>'isLogin'],function (){
    Route::get('index','Index@index');//首页
    Route::get('welcome','Index@welcome');//欢迎页
    Route::get('loginout','Index@loginout');//退出登录
});
Route::group(['prefix'=>'user','middleware'=>'isLogin'],function (){
    Route::get('list','User@list');//用户列表
});
Route::group(['prefix'=>'admin','middleware'=>'isLogin'],function (){
    Route::get('list','Admin@list');//管理员列表
    Route::get('add','Admin@add');//管理员添加
    Route::post('add','Admin@add');//管理员添加
    Route::get('{id}/edit','Admin@edit');//管理员修改页
    Route::post('update','Admin@update');//管理员修改
    Route::post('statu','Admin@statu');//管理员状态
    Route::post('reset_pass','Admin@reset_pass');//管理员密码重置

});
// Route::get('index/edit/{id}','Index@edit');
// Route::post('index/update','Index@update');
Route::fallback(function () {
    dd("404 找不到该路由");
});