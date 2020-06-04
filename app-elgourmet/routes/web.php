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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::post('/home/config_user', 'HomeController@config_user');
Route::post('/home/config_restaurante', 'HomeController@config_restaurante');
Route::post('/home/config_mesas', 'HomeController@config_mesas');
Route::get('/home/reservas', 'HomeController@reservas_view');

Route::get('/confirmar', 'ReservasController@confirmar_view');
Route::post('/confirmar', 'ReservasController@confirmar');
