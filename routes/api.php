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
Route::post('devices/{deviceapi}', 'deviceApiController@deviceUpdate');

//Device Init
Route::get('devices/{id}/init/{device}','deviceApiController@deviceInit');

//Device Connect
Route::get('devices/{id}/connect/{device}','deviceApiController@connect');

//alarm one start
Route::get('devices/{id}/alarmonestart/{device}','deviceApiController@devicealarmOneStart');

//alarm one stop
Route::get('devices/{id}/alarmonestop/{device}','deviceApiController@devicealarmOneStop');

//alarm two start
Route::get('devices/{id}/alarmtwostart/{device}','deviceApiController@devicealarmtwoStart');

//alarm two stop
Route::get('devices/{id}/alarmtwostop/{device}','deviceApiController@devicealarmtwoStop');

//no of active alarm sum

Route::get('devices/sum/test', 'deviceApiController@devicessum');

Route::get('devices/update/dayone/{id}', 'deviceApiController@deviceupdateoneday');

Route::get('devices/update/daytwo/{id}', 'deviceApiController@deviceupdatetwoday');

Route::get('device/connupdate', 'deviceApiController@connupdate');
