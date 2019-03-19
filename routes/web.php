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

route::any('/',"IndexController@index");

Route::prefix('goods')->group(function () {
    Route::get('allshops',"Goods\\GoodsController@allshops");
    Route::get('detail/{id}',"Goods\\GoodsController@detail");
    Route::get('allshops/{id}',"Goods\\GoodsController@allshops");
    Route::post('list',"Goods\\GoodsController@GetCategoryInfo");
    Route::post('sort',"Goods\\GoodsController@GetSortList");
});

route::group(['middleware'=>'user',"prefix"=>'car'],function(){
    Route::get('index',"Car\\BuycarController@index");
});

route::group(['middleware'=>'user',"prefix"=>'myself'],function(){
    Route::get('index',"Myself\\MyselfController@index");
});


route::prefix('user')->group(function(){
    route::get('login',"User\\UserController@login");
    route::get('register',"User\\UserController@register");
    route::get('forget',"User\\UserController@forget");
    route::any('doregister',"User\\UserController@doregister");
});

route::any('verify/create','CaptchaController@create');
