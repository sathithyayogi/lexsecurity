<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('devices', 'deviceApiController@devices');

Route::get('devices/{id}', 'deviceApiController@devicesByID');

Route::post('devices', 'deviceApiController@devicesSave');

//Edit Testing
Route::put('devices/{deviceapi}', 'deviceApiController@deviceUpdate');

//Device Init
Route::put('devices/{id}/init/{device}','deviceApiController@deviceInit');

//alarm one start
Route::put('devices/{id}/alarmonestart/{device}','deviceApiController@devicealarmOneStart');

//alarm one stop
Route::put('devices/{id}/alarmonestop','deviceApiController@devicealarmOneStop');

//alarm two start
Route::put('devices/{id}/alarmtwostart/{device}','deviceApiController@devicealarmtwoStart');

//alarm two stop
Route::put('devices/{id}/alarmtwostop','deviceApiController@devicealarmtwoStop');


