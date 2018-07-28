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
//===================create, update, delete, search sub kategori ===========================//
Route::resource('subberita', 'Sub_kategoriController');
//===================create, update, delete, search berita ===========================//
Route::resource('databerita', 'DataberitaController');
//===================create, update, delete, search Data Iklan  ===========================//
Route::resource('iklan', 'IklanController');
Route::get('logout', 'Auth\LoginController@logout');

