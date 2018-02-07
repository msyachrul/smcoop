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
    	$hasil = [];

    	if (count($barang) == 0) {
    		 return 'Barang tidak ditemukan';
    	}
    	else {
    		foreach ($barang as $key => $value) {
    			$hasil[] = $value->nama;
    		}
    		return $hasil;
    	
    	}




    	// return $availableTags = [
			  //     "ActionScript",
			  //     "AppleScript",
			  //     "Asp",
			  //     "BASIC",
			  //     "C",
			  //     "C++",
			  //     "Clojure",
			  //     "COBOL",
			  //     "ColdFusion",
			  //     "Erlang",
			  //     "Fortran",
			  //     "Groovy",
			  //     "Haskell",
			  //     "Java",
			  //     "JavaScript",
			  //     "Lisp",
			  //     "Perl",
			  //     "PHP",
			  //     "Python",
			  //     "Ruby",
			  //     "Scala",
			  //     "Scheme"
			  //   ];

    }
}
