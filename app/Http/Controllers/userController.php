<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    public function index()
    {
    	$cek = session('data');

    	$penjualan = DB::table('penjualans as a')
    	->join('anggotas as b','a.anggota_no','b.no')
    	->where('b.no',$cek['no'])
    	->select(
    		'a.no as penjualan_no',
    		'a.tanggal',
    		'a.total',
    		'b.no as anggota_no',
    		'b.nama',
    		'b.totalSimpanan'
    	)->get();

    	return view('pembelian')->with('data',$penjualan);
    }
}
