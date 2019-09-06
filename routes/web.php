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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('api/pembeli','PembeliController@apipembeli')->name('api.pembeli');
Route::resource('/pembeli', 'PembeliController');

Route::post('ajax-crud-list/store', 'PembeliController@store');
Route::get('ajax-crud-list/delete/{id_pembeli}', 'PembeliController@destroy');
