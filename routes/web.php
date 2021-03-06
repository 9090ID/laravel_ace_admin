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

//Route::get('/', function () {
  //  return view('welcome');
//});
Route::resource('/', 'FrontendController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//===================create, update, delete, search sub kategori ===========================//
Route::resource('subberita', 'Sub_kategoriController');
//===================create, update, delete, search berita ===========================//
Route::resource('databerita', 'DataberitaController');
//===================create, update, delete, search Data Iklan  ===========================//
Route::resource('datavideo', 'IklanvideoController');
//===================create, update, delete, search Data Iklan  ===========================//
Route::resource('iklan', 'IklanController');

Route::resource('dataproduk', 'DataProdukController');
//===================create, update, delete, search Data Iklan  ===========================//
Route::get('logout', 'Auth\LoginController@logout');

Route::get('list_produk','DataProdukController@get_list_json_produk' );
Route::get('detail_produk/{id}','DataProdukController@get_detail_produk');