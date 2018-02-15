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
            $noPenjualan = 'P-'.$nomor;
    		$get = Penjualan::where('noPenjualan',$noPenjualan)->get();
    		$cek = count($get);
    	} while ( $cek == 1 );

        $tmpBarang = DB::table('tmp_detail_penjualans as a')->join('barangs as b','a.barang_id','b.id')->select('a.id','b.nama','a.kuantitas','a.subTotal')->get();

        $tmpTotal = DB::table('tmp_detail_penjualans')->sum('subTotal');

    	return view('penjualan_input',compact('noPenjualan','tmpBarang','tmpTotal'));
    }

    public function autocompleteAnggota(Request $req) {
        $term = $req->term;
        $anggota = DB::table('anggotas')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($anggota as $key => $value) {
            $item[$key]['id'] = $value->id;
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
        // ambil harga barang
        $harga = DB::table('barangs')->select('harga')->where('id',$req->barang_id)->get()[0]->harga;
        // masukan data barang ke tabel sementara
        $barang = DB::table('tmp_detail_penjualans')->insert([
            'barang_id' => $req->barang_id,
            'kuantitas' => $req->kuantitas,
            'subTotal' => $harga*$req->kuantitas,
        ]);

        // ambil nama barang di tabel barangs lalu ditampilkan
        $tampil = DB::table('tmp_detail_penjualans as a')->join('barangs as b','a.barang_id','b.id')->select('a.id','b.nama','a.kuantitas','a.subTotal')->get();
        // ambil total penjualan barang
        $tmpTotal = DB::table('tmp_detail_penjualans')->sum('subTotal');

        return response::json(array('tampil' => $tampil, 'tmpTotal' => $tmpTotal));
        }
      }
    }

    public function inputTransaksi(Request $req) {
        $rules = array(
        'noPenjualan' => 'required',
        'anggota_id' => 'required',
        'tanggal' => 'required|date_format:Y-m-d',
        'total' => 'required|numeric|min:0',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        $tmpBarang = DB::table('tmp_detail_penjualans')->get();

        if (count($tmpBarang) < 1) {
          return response::json(array('errors'=>'kosong'));
        }

        else {
            foreach ($tmpBarang as $key => $value) {
                DB::table('detail_penjualans')->insert([
                    'noPenjualan' => $req->noPenjualan,
                    'barang_id' => $value->barang_id,
                    'kuantitas' => $value->kuantitas,
                    'subTotal' => $value->subTotal,
                ]);
            }

            DB::table('tmp_detail_penjualans')->delete();

            $penjualan = new Penjualan;
                $penjualan->noPenjualan = $req->noPenjualan;
                $penjualan->anggota_id = $req->anggota_id;
                $penjualan->tanggal = $req->tanggal;
                $penjualan->total = $req->total;
            $penjualan->save();

            return response()->json($penjualan);
        }
      }
    }
}
