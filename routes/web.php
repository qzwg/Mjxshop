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

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['privilege'])->group(function(){
    Route::resource('info','PersonController');
    Route::get('send_mobile','RegisterController@send_mobile')->name('send_mobile');
    //订单管理
    Route::resource('order','orderController');
    //地址管理
    Route::resource('adress','AdressController');
    //后台

        //系统首页
    Route::resource('system','SystemController');
        //管理员-个人信息 
    Route::resource('admin_mes','Admin_mesController');
        //管理员-列表 
    Route::resource('admin_list','Admin_listController');
        //管理员-权限管理
    Route::resource('privilege','PrivilegeController');
    
        ///产品管理-分类管理
    Route::resource('category','CategoryController');
        //产品管理-产品类表
    Route::resource('list_add','ListaddController');
        //添加商品 
    Route::resource('shop_add','Shop_addController');
        //品牌管理
    Route::resource('brand','BrandController');
});
Route::resource('register','RegisterController');
Route::resource('login','loginController');
Route::resource('admin','AdminController');  

//前端
Route::resource('index','IndexController');  
    //商品搜索页
Route::resource('search','SearchController');
    //3级列表搜索
Route::resource('sort','Shop_sortController');
    //商品详情页
Route::resource('shop_mes','Shop_mesController');
    //商品购物车
Route::resource('cart','Shop_cartController');








    


