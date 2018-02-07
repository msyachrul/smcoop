<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;

class pembelianController extends Controller
{
    public function index() {
    	return view('pembelian');
    }

    public function autocomplete(Request $req) {


    	$term = $req->term;
    	$barang = Barang::where('nama','LIKE','%'.$term.'%')->get();
    	$hasil = array();

    	foreach ($barang as $key => $value) {
    		$hasil[$key]['value'] = $value->id;
   			$hasil[$key]['label'] = $value->nama;

       	}

       	return response()->json($hasil);
 	
    }
}
