<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Validator;
use Response;
use Illuminate\Support\Facades\input;

class barangController extends Controller
{
    public function index() {

    	$barang = Barang::all();

    	return view('barang',compact('barang'));
    }

    public function tambah(Request $req) {

    	$rules = array(
    		'nama' => 'required',
    	);

    	$validator = Validator::make(input::all(),$rules);

    	if ($validator->fails()) {
    		return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
    	}
    	else {

            $cek = Barang::where('nama',$req->nama)->get();

            if(count($cek)>0) {
                return response::json(array('errors'=>'ada'));
            }
            else {
    		$barang = new Barang;
    			$barang->nama = $req->nama;
    		$barang->save();

    		return response()->json($barang);
            }
    	}
    }

    public function update(Request $req) {

    	$rules = array(
    		'id' => 'required',
    		'nama' => 'required',
    	);

    	$validator = Validator::make(input::all(),$rules);

    	if ($validator->fails()) {
    		return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
    	}
    	else {
    		$barang = Barang::find($req->id);
    			$barang->nama = $req->nama;
    		$barang->save();

    		return response()->json($barang);
    	}    	
    }

    public function hapus(Request $req) {
    	
    	$rules = array(
    		'id' => 'required',
    	);

    	$validator = Validator::make(input::all(),$rules);

    	if ($validator->fails()) {
    		return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
    	}
    	else {
    		$barang = Barang::find($req->id)->delete();
    		return response()->json($barang);
    	}
    }
}
