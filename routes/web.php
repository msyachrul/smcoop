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



Route::group(['middleware' => 'userAuth'],function(){
  Route::get('/', function() {
    return view('home');
  });
  Route::get('/profile','anggotaController@profile');
  Route::post('/profile','anggotaController@updateProfile');
  Route::get('/pembelian','penjualanController@index');
  Route::post('/pembelian','penjualanController@pembelianAnggota');
  Route::post('/pembelian/detail','penjualanController@detailPembelianAnggota');
  Route::get('/tagihan','penjualanController@tagihan');
  Route::post('/tagihan','penjualanController@cariTagihan');
  Route::post('/ubahpin','anggotaController@ubahPin');
});

Route::get('/error', function(){
  return view('layouts.error');
});

Route::get('/masuk', function(){
	return view('masuk');
})->middleware('sessionAuth');

Route::post('/masuk', 'AuthController@login');

Route::get('/keluar', 'AuthController@logout');

Route::group(['prefix' => 'admin','middleware' => 'adminAuth'],function() {
  Route::get('/', function() {
    return view('blank');
  });

  // Profile

  Route::get('/profile','anggotaController@profile');
  Route::post('/profile','anggotaController@updateProfile');
  Route::post('/ubahpin','anggotaController@ubahPin');

  // Anggota
  Route::group(['prefix' => 'anggota'], function(){    
    Route::get('/','anggotaController@index');
    Route::post('/daftar','anggotaController@tambah');
    Route::post('/edit','anggotaController@update');
    Route::post('/hapus','anggotaController@hapus');
  });

  // Barang
  Route::group(['prefix' => 'barang'], function(){
    Route::get('/','barangController@index');
    Route::post('/daftar','barangController@tambah');
    Route::post('/edit', 'barangController@update');
    Route::post('/hapus','barangController@hapus');
  });

  // Penjualan
  Route::group(['prefix' => 'penjualan'], function(){
    Route::get('/', 'penjualanController@index');
    Route::post('/', 'penjualanController@cari');
    Route::prefix('input')->group(function(){
      Route::get('/', 'penjualanController@indexInput');
      Route::get('/anggota/autocomplete', 'penjualanController@autocompleteAnggota');
      Route::get('/barang/autocomplete', 'penjualanController@autocompleteBarang');
      Route::post('/barang/tambah', 'penjualanController@inputTmpBarang');
      Route::post('/transaksi', 'penjualanController@inputTransaksi');
      Route::post('/barang/hapus', 'penjualanController@hapusTmpBarang');
      Route::post('/barang/cek', 'penjualanController@cek');
    });
    Route::post('/batal', 'penjualanController@batal');
    Route::get('/{no}', 'penjualanController@detail');
    Route::prefix('edit')->group(function(){
      Route::get('/{no}', 'penjualanController@edit');
      Route::post('/barang/tambah', 'penjualanController@tambahBarang');
      Route::post('/barang/hapus', 'penjualanController@hapusBarang');
    });
    Route::get('/hapus/{no}','penjualanController@hapusTransaksi');
  });

  Route::group(['prefix' => 'laporan'],function() {
    Route::get('/penjualan','laporanController@index');
    Route::post('/penjualan','laporanController@cari');
    Route::post('/penjualan/detail','laporanController@detail');
  });
  
});