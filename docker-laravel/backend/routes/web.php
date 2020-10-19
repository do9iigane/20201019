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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'App\Http\Controllers\UserController@index')->name('user.list');
Route::get('/user/register', 'App\Http\Controllers\UserController@register')->name('user.register');
Route::post('/user/register', 'App\Http\Controllers\UserController@store')->name('user.store');
Route::get('/user/detail/{user}', 'App\Http\Controllers\UserController@detail')->name('user.detail');

Route::get('/consultation', 'App\Http\Controllers\ConsultationController@index')->name('consultation.list');
Route::get('/consultation/register/{user}', 'App\Http\Controllers\ConsultationController@register')->name('consultation.register');
Route::post('/consultation/register/{user}', 'App\Http\Controllers\ConsultationController@store')->name('consultation.store');
