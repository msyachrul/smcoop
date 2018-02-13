<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use Validator;
use Response;
use Illuminate\Support\Facades\input;
use Illuminate\Support\Facades\DB;

class penjualanController extends Controller
{
    public function index() {
    	return view('penjualan');
    }

    public function input() {

        $nomor = 0;

    	do {
    		$nomor++;
            $kode = 'P-';
            $noPenjualan = $kode.$nomor;
    		$get = Penjualan::where('noPenjualan',$noPenjualan)->get();
    		$cek = count($get);
    	} while ( $cek == 1 );

    	return view('penjualan_input',compact('noPenjualan'));

    }

    public function autocompleteAnggota(Request $req) {
        $term = $req->term;
        $anggota = DB::table('anggotas')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($anggota as $key => $value) {
            $item[$key]['value'] = $value->noAnggota;
            $item[$key]['label'] = $value->nama;
        }

        return response()->json($item);
    }

    public function autocompleteBarang(Request $req) {
        $term = $req->term;
        $barang = DB::table('barangs')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($barang as $key => $value) {
            $item[$key]['value'] = $value->id;
            $item[$key]['label'] = $value->nama;
        }

        return response()->json($item);
    }
}
