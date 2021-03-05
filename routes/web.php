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
// Route::get('index/edit/{id}','Index@edit');
// Route::post('index/update','Index@update');
Route::fallback(function () {
    dd("404 找不到该路由");
});