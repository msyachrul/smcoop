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
        $penjualan = DB::table('penjualans')->orderBy('tanggal','ASC')->get();

    	return view('penjualan',compact('penjualan'));
    }

    public function inputPenjualan() {
        $nomor = 0;

    	do {
    		$nomor++;
            $noPenjualan = 'P-'.$nomor;
    		$get = Penjualan::where('noPenjualan',$noPenjualan)->get();
    		$cek = count($get);
    	} while ( $cek == 1 );

        // ambil nama barang
        $tmpBarang = DB::table('tmp_detail_penjualans as a')->join('barangs as b','a.barang_id','b.id')->select('a.id','b.nama','a.kuantitas','a.subTotal')->get();
        // ambil total barang
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
            $kuantitas = $cek[0]->kuantitas+$req->kuantitas;
            $subTotal = $cek[0]->harga*$kuantitas;

            $barang = DB::table('tmp_detail_penjualans')->where('barang_id',$req->barang_id)->update([
                'kuantitas' => $kuantitas,
                'subTotal' => $subTotal,
            ]);

            return response()->json($barang);
        }
        else {
        // ambil harga barang
        $harga = DB::table('barangs')->select('harga')->where('id',$req->barang_id)->get()[0]->harga;
        $subTotal = $harga*$req->kuantitas;
        // masukan data barang ke tabel sementara
        $barang = DB::table('tmp_detail_penjualans')->insert([
            'barang_id' => $req->barang_id,
            'harga' => $harga,
            'kuantitas' => $req->kuantitas,
            'subTotal' => $subTotal,
        ]);

        return response()->json($barang);
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
                    'harga' => $value->harga,
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

    public function hapusBarang(Request $req) {
        
        $barang = DB::table('tmp_detail_penjualans')->where('id',$req->id)->delete();

        return response()->json($barang);
    }

    public function batal() {
        DB::table('tmp_detail_penjualans')->delete();
    }

}
