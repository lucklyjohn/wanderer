<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/main','MainController@render');

Route::group(['prefix'=>'people'],function () {

    Route::get('/render', 'PeopleController@render');

});






Route::get('/getCars','Cars\CarInfosController@index');

Route::post('/getVerifyCode','Cars\AccountController@getVerifyCode');

Route::post('/testVerifyCode','Cars\AccountController@testVerifyCode');