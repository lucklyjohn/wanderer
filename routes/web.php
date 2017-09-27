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
    return view('main');
});

Route::get('/cars', function () {
    return view('cars');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth','prefix'=>'people'],function (){

    //进入个人主页
    Route::get('zonepage','PeopleController@homepage')->name('people.zonepage');

    Route::get('account','AccountController@index')->name('people.account');

});

Route::group(['prefix'=>'cars'],function (){

    //进入个人主页
    Route::post('/login','Cars\AccountController@login');

    Route::get('/is_login','Cars\AccountController@is_login');

    Route::get('/logout','Cars\AccountController@logout');

    Route::post('/passagerRegister','Cars\AccountController@passagerRegister');

    Route::post('/driverRegister','Cars\AccountController@driverRegister');

});

Auth::routes();