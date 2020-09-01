<?php

use App\Events\WebsocketDemoEvent;
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
//     return view('dashboard');
// });

Route::get('/', 'dashboardController@index');

Auth::routes();

Route::get('/diagnostics', 'diagnosticController@index')->name('home');
Route::get('/diagnostics/{id}', 'diagnosticController@show')->name('show');

Route::get('/device/config/{id}', 'deviceSettingController@show')->name('deviceset');
Route::put('/device/config/{id}', 'deviceSettingController@change');
Route::get('/device/mobilenumber/', 'deviceSettingController@view');
Route::get('/device/mobilenumber/add', 'deviceSettingController@create');
Route::post('/device/mobilenumber/add', 'deviceSettingController@stored');
Route::delete('/device/mobilenumber/delete/{$id}', 'deviceSettingController@destroyed');
Route::resource('devices', 'deviceController');
