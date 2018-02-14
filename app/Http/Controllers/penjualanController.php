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

        $tmpBarang = DB::table('tmp_detail_penjualans as a')->join('barangs as b','a.barang_id','b.id')->select('a.id','b.nama','a.kuantitas','a.subTotal')->get();

    	return view('penjualan_input',compact('noPenjualan','tmpBarang'));

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

    public function inputBarang(Request $req) {
        $rules = array(
        'noPenjualan' => 'required',
        'barang_id' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {

        $cek = DB::table('tmp_detail_penjualans')->where('barang_id',$req->barang_id)->get();

        if (count($cek) > 0) {
          return response::json(array('errors'=>'ada'));
        }
        else {

        $harga = DB::table('barangs')->select('harga')->where('id',$req->barang_id)->get()[0]->harga;

        $barang = DB::table('tmp_detail_penjualans')->insert([
            'noPenjualan' => $req->noPenjualan,
            'barang_id' => $req->barang_id,
            'kuantitas' => $req->kuantitas,
            'subTotal' => $harga*$req->kuantitas,
        ]);


        $tampil = DB::table('tmp_detail_penjualans as a')->join('barangs as b','a.barang_id','b.id')->select('a.id','b.nama','a.kuantitas','a.subTotal')->get();

        return response()->json($tampil);
        }
      }
    }
}
