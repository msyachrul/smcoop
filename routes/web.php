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



Route::group(['middleware' => 'loginAuth'],function(){
  Route::get('/',function(){
    return view('home');
  });
  Route::get('/pembelian', 'userController@index');
});

Route::get('/masuk', function(){
	return view('masuk');
});

Route::post('/masuk', 'AuthController@login');

Route::get('/keluar', 'AuthController@logout');

Route::group(['prefix' => 'admin','middleware' => 'adminAuth'],function() {
  Route::get('/', function() {
    return view('blank');
  });

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

  // Pembelian
  Route::group(['prefix' => 'pembelian'], function(){
    Route::get('/', 'pembelianController@tampil');
    Route::get('/autocomplete', 'pembelianController@autocomplete');
    Route::post('/input', 'pembelianController@input');
    Route::post('/edit', 'pembelianController@update');
    Route::post('/hapus', 'pembelianController@hapus');
    Route::post('/cari', 'pembelianController@cari');
  });

  // Penjualan
  Route::group(['prefix' => 'penjualan'], function(){
    Route::get('/', 'penjualanController@index');
    Route::prefix('input')->group(function(){
      Route::get('/', 'penjualanController@inputPenjualan');
      Route::get('/anggota/autocomplete', 'penjualanController@autocompleteAnggota');
      Route::get('/barang/autocomplete', 'penjualanController@autocompleteBarang');
      Route::post('/barang/tambah', 'penjualanController@inputBarang');
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
});