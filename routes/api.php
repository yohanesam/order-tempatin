
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

Route::post('search/room', 'RoomController@api_search');

Route::get('kota/{id}', 'BuildingController@api_kota');
Route::get('city/{id}', 'BuildingController@api_city');
Route::get('province/{id}', 'BuildingController@create');
Route::get('form/detail/{id}', 'FormController@api_form_detail');
Route::get('package/detail/{id}', 'RoomController@api_package_detail');

Route::post('login', 'Auth\LoginController@signin');
Route::post('register', 'Auth\RegisterController@register');

Route::get('token', 'UserController@showToken');
Route::get('users', 'UserController@index');
Route::get('user/{id}', 'UserController@show');
Route::post('user/edit/{id}', 'UserController@update');

Route::get('rooms', 'RoomController@index');
Route::get('room/categories', 'RoomCategoryController@index');
Route::get('room/{id}', 'RoomController@edit');


Route::get('room/setups', 'SetupController@index');

Route::get('facility/categories', 'FacilityCategoryController@index');

Route::get('building/type', 'BuildingTypeController@index');

Route::get('packages', 'PackageController@index');

Route::get('forms', 'FormController@index');
Route::get('form/{id}', 'FormController@api_form_detail');

Route::get('buildings', 'BuildingController@index');

Route::get('promo', 'PromoController@index');

// Route::get('schedule', 'ScheduleController@index');




//////////////////////////////////////////////////////////////////////////
Route::post('create_order', 'OrderController@store');
Route::get('orders/{id}', 'OrderController@index');
Route::get('order/{id}', 'OrderController@show');
Route::post('payment_callback', 'OrderController@store');
Route::get('room_schedule/{id}', 'OrderScheduleController@schedule');
Route::get('order_schedule/{id}', 'OrderScheduleController@index');
Route::get('order_form/{id}', 'OrderFormValueController@show');
