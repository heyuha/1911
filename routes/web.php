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


Route::domain("1911.laravel.com")->group(function(){
	Route::get('/', function () {
	    return view('welcome');
	});

	Route::get('index','TextController@index');
	Route::get('add','TextController@add');
	Route::post('adddo','TextController@adddo');
	// 必填参数
	Route::get('user/{id}',function($id){
		return 'user'.$id;
	});
	Route::get('goods/{id}/{name}','TextController@goods');
	// 可选参数
	Route::get('show/{id?}','TextController@show');
	Route::get('detail/{id}/{name?}','TextController@detail');
	// 后台品牌
	Route::prefix('brand')->middleware('login')->group(function(){
		Route::get('/','Admin\BrandController@index');//展示
		Route::post('checkName','Admin\BrandController@checkName');
		Route::get('create','Admin\BrandController@create');//添加
		Route::post('store','Admin\BrandController@store');//执行添加
		Route::get('destroy/{id}','Admin\BrandController@destroy');//删除
		Route::get('edit/{id}','Admin\BrandController@edit');//修改
		Route::post('update/{id}','Admin\BrandController@update');//执行修改
	});
	// 后台分类
	Route::prefix('cate')->middleware('login')->group(function(){
		Route::get('/','Admin\CateController@index');//展示
		Route::post('checkName','Admin\CateController@checkName');
		Route::get('create','Admin\CateController@create');//添加
		Route::post('store','Admin\CateController@store');//执行添加
		Route::get('destroy/{id}','Admin\CateController@destroy');//删除
		Route::get('edit/{id}','Admin\CateController@edit');//修改
		Route::post('update/{id}','Admin\CateController@update');//执行修改
	});
	// 后台商品
	Route::prefix('goods')->middleware('login')->group(function(){
		Route::get('/','Admin\GoodsController@index');//展示
		Route::post('checkName','Admin\GoodsController@checkName');
		Route::get('create','Admin\GoodsController@create');//添加
		Route::post('store','Admin\GoodsController@store');//执行添加
		Route::get('destroy','Admin\GoodsController@destroy');//删除
		Route::get('edit/{id}','Admin\GoodsController@edit');//修改
		Route::post('update/{id}','Admin\GoodsController@update');//执行修改
	});
	// 后台管理员管理
	Route::prefix('admin')->middleware('login')->group(function(){
		Route::get('/','Admin\AdminController@index');//展示
		Route::post('checkName','Admin\AdminController@checkName');//展示
		Route::get('create','Admin\AdminController@create');//添加
		Route::post('store','Admin\AdminController@store');//执行添加
		Route::get('destroy/{id}','Admin\AdminController@destroy');//删除
		Route::get('edit/{id}','Admin\AdminController@edit');//修改
		Route::post('update/{id}','Admin\AdminController@update');//执行修改
	});


	Route::get('/login','Admin\LoginController@index');//登录
	Route::post('/login/logindo','Admin\LoginController@logindo');//登录展示
	Route::get('/logout','Admin\LoginController@logout');//退出登录
	// 练习cookie操作
	Route::get('/getcookie','Admin\LoginController@getcookie');//获取cookie
	Route::get('/setcookie','Admin\LoginController@setcookie');//设置cookie

});



// 前台模块
Route::domain("www.1911laravel.com")->group(function(){
	// 前台首页
	Route::get('/',"Index\IndexController@index")->name('shop.index');

	Route::prefix('login')->group(function(){
		Route::post("/regstore","Index\LoginController@regstore");// 前台执行注册添加
		Route::get('/reg','Index\LoginController@reg');// 前台注册
		Route::get('/',"Index\LoginController@login");// 前台登录
		Route::post('/logindo','Index\LoginController@logindo');// 登录验证
		Route::get('/sendSms',"Index\LoginController@sendSms");//手机号发送短信验证码
		Route::get('/sendEmail',"Index\LoginController@sendEmail");//邮箱发送邮件
		Route::get('/checkName',"Index\LoginController@checkName");//验证账号唯一性
		Route::get('/proinfo/{id}',"Index\LoginController@proinfo")->name('shop.proinfo');//商品详情页面
	});

	// 前台购物车
	Route::prefix('car')->middleware('islogin')->group(function(){
		Route::get('/caradd','Index\CarController@caradd');//加入购物车
		Route::get('/carcar','Index\CarController@carcar')->name('shop.car');//购物车列表
		Route::get('/carpay/{id}','Index\CarController@carpay');//结算
	});
	// 提交订单
	Route::prefix('order')->middleware('islogin')->group(function(){
		Route::get('/order',"Index\OrderController@order");
		Route::get('/orderpay',"Index\OrderController@orderpay");
	});
});


