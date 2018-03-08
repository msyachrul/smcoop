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
    public function index()
    {
        $penjualan = Penjualan::where('tanggal',date('Y-m-d'))->orderBy('tanggal','DESC')->get();

    	return view('admin.penjualan',compact('penjualan'));
    }

    public function cari(Request $request)
    {
        $tanggal = ['dari'=>$request->dari,'sampai'=>$request->sampai];
        $penjualan = Penjualan::whereBetween('tanggal',[$request->dari,$request->sampai])->orderBy('tanggal','ASC')->get();

        return view('admin.penjualan')->with('penjualan',$penjualan)->with('tanggal',$tanggal);
    }

    public function inputPenjualan() {
        $i = 0;

    	do {
    		$i++;
            $no = 'P-'.$i;
    		$get = Penjualan::where('no',$no)->get();
    		$cek = count($get);
    	} while ( $cek == 1 );

        // ambil nama barang
        $tmpBarang = DB::table('tmp_detail_penjualans')->get();
        // ambil total barang
        $tmpTotal = DB::table('tmp_detail_penjualans')->sum('subTotal');

    	return view('admin.penjualan_input',compact('no','tmpBarang','tmpTotal'));
    }

    public function autocompleteAnggota(Request $req) {
        $term = $req->term;
        $anggota = DB::table('anggotas')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($anggota as $key => $value) {
            $item[$key]['no'] = $value->no;
            $item[$key]['label'] = $value->nama;
        }

        return response()->json($item);
    }

    public function autocompleteBarang(Request $req) {
        $term = $req->term;
        $barang = DB::table('barangs')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($barang as $key => $value) {
            $item[$key]['id'] = $value->id;
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
        $cek = DB::table('tmp_detail_penjualans')->where('barang_id',$req->barang_id)->first();

        if (!empty($cek)) {
            $kuantitas = $cek->kuantitas+$req->kuantitas;
            $subTotal = $cek->harga*$kuantitas;

            $tmpBarang = DB::table('tmp_detail_penjualans')->where('barang_id',$req->barang_id)->update([
                'kuantitas' => $kuantitas,
                'subTotal' => $subTotal,
            ]);

            return response()->json($tmpBarang);
        }
        else {
        // ambil data barang
        $barang = DB::table('barangs')->where('id',$req->barang_id)->first();
        $subTotal = $barang->harga*$req->kuantitas;
        // masukan data barang ke tabel sementara
        $tmpBarang = DB::table('tmp_detail_penjualans')->insert([
            'barang_id' => $req->barang_id,
            'nama' => $barang->nama,
            'harga' => $barang->harga,
            'kuantitas' => $req->kuantitas,
            'subTotal' => $subTotal,
        ]);

        return response()->json($tmpBarang);
        }
      }
    }

    public function inputTransaksi(Request $req) {
        $rules = array(
        'no' => 'required',
        'anggota_no' => 'required',
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
            $penjualan = new Penjualan;
                $penjualan->no = $req->no;
                $penjualan->anggota_no = $req->anggota_no;
                $penjualan->tanggal = $req->tanggal;
                $penjualan->total = $req->total;
            $penjualan->save();

            foreach ($tmpBarang as $key => $value) {
                DB::table('detail_penjualans')->insert([
                    'penjualan_no' => $req->no,
                    'barang_id' => $value->barang_id,
                    'nama' => $value->nama,
                    'harga' => $value->harga,
                    'kuantitas' => $value->kuantitas,
                    'subTotal' => $value->subTotal,
                ]);
            }

            DB::table('tmp_detail_penjualans')->delete();


            return response()->json($penjualan);
        }
      }
    }

    public function hapusTmpBarang(Request $req) {
        return DB::table('tmp_detail_penjualans')->where('id',$req->id)->delete();
    }

    public function cek() {
        $cek = DB::table('tmp_detail_penjualans')->get();

        if (count($cek) < 1) {
            return response()->json($cek);
        }
        else {
            return response()->json($cek);
        }
    }

    public function batal() {        
        return DB::table('tmp_detail_penjualans')->delete();
    }

    public function detail(Request $req) {

        $detail = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->get();
        // $penjualan = Penjualan::where('no',$req->no)->get();
        $penjualan = DB::table('penjualans as a')->join('anggotas as b','a.anggota_no','b.no')->where('a.no',$req->no)->select('a.no','a.tanggal','a.total','a.anggota_no','b.nama')->first();

        return view('admin.penjualan_detail',compact('detail','penjualan'));
    }

    public function edit(Request $req) {

        $detail = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->get();
        // $penjualan = Penjualan::where('no',$req->no)->get();
        $penjualan = DB::table('penjualans as a')->join('anggotas as b','a.anggota_no','b.no')->where('a.no',$req->no)->select('a.no','a.tanggal','a.total','a.anggota_no','b.nama')->first();

        return view('admin.penjualan_edit',compact('detail','penjualan'));

    }

    public function tambahBarang(Request $req) {
      $rules = array(
        'barang_id' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        $cek = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->where('barang_id',$req->barang_id)->first();

        if (!empty($cek)) {
            $kuantitas = $cek->kuantitas+$req->kuantitas;
            $subTotal = $cek->harga*$kuantitas;

            $barang = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->where('barang_id',$req->barang_id)->update([
                'kuantitas' => $kuantitas,
                'subTotal' => $subTotal,
            ]);
        }
        else {
            // ambil data barang
            $data = DB::table('barangs')->where('id',$req->barang_id)->first();
            $subTotal = $data->harga*$req->kuantitas;
            // masukan data barang ke tabel
            $barang = DB::table('detail_penjualans')->insert([
                'penjualan_no' => $req->no,
                'barang_id' => $req->barang_id,
                'nama' => $data->nama,
                'harga' => $data->harga,
                'kuantitas' => $req->kuantitas,
                'subTotal' => $subTotal,
            ]);
        }

        $total = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->sum('subTotal');

        return Penjualan::where('no',$req->no)->update([
            'total' => $total,
        ]);
      }
    }

    public function hapusBarang(Request $req) {
    $rules = array(
        'no' => 'required',
        'barang_id' => 'required|numeric|min:0',
      );

      $validator = Validator::make(input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        DB::table('detail_penjualans')->where('penjualan_no',$req->no)->where('barang_id',$req->barang_id)->delete();
        
        $total = DB::table('detail_penjualans')->where('penjualan_no',$req->no)->sum('subTotal');

        return Penjualan::where('no',$req->no)->update([
            'total' => $total,
        ]);
      }
    }

    public function hapusTransaksi(Request $req) {

        Penjualan::where('no',$req->no)->delete();

        DB::table('detail_penjualans')->where('penjualan_no',$req->no)->delete();

        return redirect()->back();

    }

}
