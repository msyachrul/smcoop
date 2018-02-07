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
    return view('login');
});

Route::get('/home', function () {
    return view('user');
});

Route::get('/login', function(){
	return view('login');
});

Route::post('/login', 'anggotaController@testLogin');
Route::post('/', 'anggotaController@testLogin');

Route::get('/blank', function() {
	return view('blank');
});



Route::group(['middleware' => ['web']], function() {
  // Anggota
  Route::resource('anggota','anggotaController');
  Route::post('daftarAnggota','anggotaController@tambahAnggota');
  Route::post('editAnggota','anggotaController@updateAnggota');
  Route::post('hapusAnggota','anggotaController@hapusAnggota');

  // Barang
  Route::resource('barang','barangController');
  Route::post('daftarBarang','barangController@tambahBarang');
  Route::post('editBarang', 'barangController@updateBarang');
  Route::post('hapusBarang','barangController@hapusBarang');

  Route::get('pembelian', function(){
  	return view('pembelian');
  });

  Route::get('pembelian/autocomplete', 'pembelianController@autocomplete');
});
