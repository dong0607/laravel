<?php

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
/**
 * 微信商城首页
 * get
 */
Route::get('/', function () {
    return view('index');
});


//未登录不访问
Route::group(['middleware'=>'login','namespace'=>'Index'],function () {
	//购物车 
	Route::get('shopcart','IndexController@shopcart');
	Route::post('cateadd','IndexController@cateadd');
	Route::post('catedel','IndexController@catedel');
	Route::post('cateseek','IndexController@cateseek');
	Route::post('catesort','IndexController@catesort');
	Route::post('catesort1','IndexController@catesort1');
	Route::post('catesort2','IndexController@catesort2');
	Route::post('cartdelete','IndexController@cartdelete');
	Route::post('t','IndexController@t');
	Route::post('j','IndexController@j');
	Route::post('settle','IndexController@settle');
	//添加收货地址
	Route::get('writeaddr','IndexController@writeaddr');
	//接受入库
	Route::post('writeadd','IndexController@writeadd');
	//我的潮购 
	Route::get('userpage','IndexController@userpage');
	//地址管理
	Route::get('address','IndexController@address');
});
route::any('verify/create','CaptchaController@create');
//未登录可访问
Route::namespace('Index')->group(function () {
	//主页面
	Route::get('index','IndexController@index');
	Route::post('indexwill','IndexController@indexwill');

	//商品分类管理
	Route::get('allshops','IndexController@allshops');
	Route::any('category','IndexController@category');

	//登录
	Route::get('login','IndexController@login');
	//商品详情
	Route::any('shopcontent','IndexController@shopcontent');
	//登录
	Route::get('login','IndexController@login');
	Route::post('loginadd','IndexController@loginadd');
	
	//注册验证码
	Route::get('regauth','IndexController@regauth');

	//注册
	Route::get('register','IndexController@register');
	Route::any('registeradd','IndexController@registeradd');
	Route::post('telcode','IndexController@telcode');

	
});