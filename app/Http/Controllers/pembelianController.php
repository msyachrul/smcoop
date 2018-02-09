<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Barang;
use App\PembelianView;
use Validator;
use Response;
use Illuminate\Support\Facades\input;

class pembelianController extends Controller
{
    public function tampil() {
    	$tanggal = date('Y-m-d');
      $pembelian = PembelianView::where('tanggal','=',$tanggal)->get();

      return view('pembelian',compact('pembelian'));
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

    public function input(Request $req) {
      $rules = array(
        'tanggal' => 'required|date_format:Y-m-d',
        'harga' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
        'barang_id' => 'required',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {

        $cek = Pembelian::where('tanggal',$req->tanggal)->where('barang_id',$req->barang_id)->where('harga',$req->harga)->get();

        if (count($cek) > 0) {
          return response::json(array('errors'=>'ada'));
        }
        else {
        $pembelian = new Pembelian;
          $pembelian->tanggal = $req->tanggal;
          $pembelian->harga = $req->harga;
          $pembelian->kuantitas = $req->kuantitas;
          $pembelian->barang_id = $req->barang_id;  
        $pembelian->save();

        return response()->json($pembelian);
        }
      }
    }

    public function update(Request $req) {
      $rules = array(
        'id' => 'required',
        'harga' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        $pembelian = Pembelian::find($req->id);
          $pembelian->harga = $req->harga;
          $pembelian->kuantitas = $req->kuantitas;
        $pembelian->save();

        return response()->json($pembelian);
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
        $pembelian = Pembelian::find($req->id)->delete();
        return response()->json($pembelian);
      }
    }
    
}
