<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\DetailPenjualan;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class penjualanController extends Controller
{
    public function index()
    {
        $cek = session('data');

        if ($cek['admin'] == true)
        {
            $penjualan = Penjualan::where('tanggal',date('Y-m-d'))->orderBy('tanggal','DESC')->get();

            return view('admin.penjualan',compact('penjualan'));
        }

        return view('pembelian');     
    }

    public function cari(Request $request)
    {
        $dari = $request->dariTahun."-".$request->dariBulan."-".$request->dariTanggal;
        $sampai = $request->sampaiTahun."-".$request->sampaiBulan."-".$request->sampaiTanggal;
    
        $tanggal = ["dari" => $dari,"sampai" => $sampai];

        $penjualan = Penjualan::whereBetween('tanggal',[$dari,$sampai])->orderBy('tanggal','ASC')->get();

        return view('admin.penjualan',compact('tanggal','penjualan'));
    }

    public function indexInput() {
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
        $info = session('info');

        if(isset($info)) {
            return view('admin.penjualan_input',compact('no','tmpBarang','tmpTotal','info'));            
        }

    	return view('admin.penjualan_input',compact('no','tmpBarang','tmpTotal'));
    }

    public function autocompleteAnggota(Request $request) {
        $term = $request->term;
        $anggota = DB::table('anggotas')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($anggota as $key => $value) {
            $item[$key]['no'] = $value->no;
            $item[$key]['label'] = $value->nama;
        }

        return response()->json($item);
    }

    public function autocompleteBarang(Request $request) {
        $term = $request->term;
        $barang = DB::table('barangs')->where('nama','LIKE','%'.$term.'%')->orderBy('nama','ASC')->get();
        $item = [];

        foreach ($barang as $key => $value) {
            $item[$key]['id'] = $value->id;
            $item[$key]['label'] = $value->nama;
        }

        return response()->json($item);
    }

    public function inputTmpBarang(Request $request) {
      $rules = array(
        'barang_id' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
      );

      $validator = Validator::make(Input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        $cek = DB::table('tmp_detail_penjualans')->where('barang_id',$request->barang_id)->first();

        if (!empty($cek)) {
            $kuantitas = $cek->kuantitas+$request->kuantitas;
            $subTotal = $cek->harga*$kuantitas;

            $tmpBarang = DB::table('tmp_detail_penjualans')->where('barang_id',$request->barang_id)->update([
                'kuantitas' => $kuantitas,
                'subTotal' => $subTotal,
            ]);

            return response()->json($tmpBarang);
        }
        else {
        // ambil data barang
        $barang = DB::table('barangs')->where('id',$request->barang_id)->first();
        $subTotal = $barang->harga*$request->kuantitas;
        // masukan data barang ke tabel sementara
        $tmpBarang = DB::table('tmp_detail_penjualans')->insert([
            'barang_id' => $request->barang_id,
            'nama' => $barang->nama,
            'harga' => $barang->harga,
            'kuantitas' => $request->kuantitas,
            'subTotal' => $subTotal,
        ]);

        return response()->json($tmpBarang);
        }
      }
    }

    public function inputTransaksi(Request $request) {
        $rules = array(
        'no' => 'required',
        'total' => 'required|numeric|min:0',
        'tanggal' => 'required|numeric|min:0',
        'bulan' => 'required|numeric|min:0',
        'tahun' => 'required|numeric|min:0',
        'anggota_no' => 'required',
      );

      $validator = Validator::make(Input::all(),$rules);

      if ($validator->fails()) {
        return redirect('/admin/penjualan/input')->with('info',['result' => 'error','ket' => $validator->getMessageBag()->first()]);
      }
      else {
        $tmpBarang = DB::table('tmp_detail_penjualans')->get();

        if (count($tmpBarang) < 1) {
          return redirect('/admin/penjualan/input')->with('info',['result' => 'error','ket' => 'Barang masih kosong!']);
        }

        else {
            $penjualan = new Penjualan;
                $penjualan->no = $request->no;
                $penjualan->anggota_no = $request->anggota_no;
                $penjualan->tanggal = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;
                $penjualan->total = $request->total;
            $penjualan->save();

            foreach ($tmpBarang as $key => $value) {
                $detailPenjualan = new DetailPenjualan;
                    $detailPenjualan->penjualan_no = $request->no;
                    $detailPenjualan->barang_id = $value->barang_id;
                    $detailPenjualan->nama = $value->nama;
                    $detailPenjualan->harga = $value->harga;
                    $detailPenjualan->kuantitas = $value->kuantitas;
                    $detailPenjualan->subTotal = $value->subTotal;
                $detailPenjualan->save();
            }

            DB::table('tmp_detail_penjualans')->delete();

            return redirect('/admin/penjualan/input')->with('info',['result' => 'success','ket' => 'Input transaksi penjualan berhasil']);
        }
      }
    }

    public function hapusTmpBarang(Request $request) {
        return DB::table('tmp_detail_penjualans')->where('id',$request->id)->delete();
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

    public function detail(Request $request) {

        $detail = DB::table('detail_penjualans')->where('penjualan_no',$request->no)->get();
        // $penjualan = Penjualan::where('no',$request->no)->get();
        $penjualan = DB::table('penjualans as a')->join('anggotas as b','a.anggota_no','b.no')->where('a.no',$request->no)->select('a.no','a.tanggal','a.total','a.anggota_no','b.nama')->first();

        return view('admin.penjualan_detail',compact('detail','penjualan'));
    }

    public function edit(Request $request) {

        $detail = DetailPenjualan::where('penjualan_no',$request->no)->get();
        // $penjualan = Penjualan::where('no',$request->no)->get();
        $penjualan = DB::table('penjualans as a')->join('anggotas as b','a.anggota_no','b.no')->where('a.no',$request->no)->select('a.no','a.tanggal','a.total','a.anggota_no','b.nama')->first();

        return view('admin.penjualan_edit',compact('detail','penjualan'));

    }

    public function tambahBarang(Request $request) {
      $rules = array(
        'barang_id' => 'required|numeric|min:0',
        'kuantitas' => 'required|numeric|min:0',
      );

      $validator = Validator::make(Input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        $cek = DetailPenjualan::where('penjualan_no',$request->no)->where('barang_id',$request->barang_id)->first();

        if (!empty($cek)) {
            $kuantitas = $cek->kuantitas+$request->kuantitas;
            $subTotal = $cek->harga*$kuantitas;

            $barang = DetailPenjualan::where('penjualan_no',$request->no)->where('barang_id',$request->barang_id)->update([
                'kuantitas' => $kuantitas,
                'subTotal' => $subTotal,
            ]);
        }
        else {
            // ambil data barang
            $data = DB::table('barangs')->where('id',$request->barang_id)->first();
            $subTotal = $data->harga*$request->kuantitas;
            // masukan data barang ke tabel
            $barang = DB::table('detail_penjualans')->insert([
                'penjualan_no' => $request->no,
                'barang_id' => $request->barang_id,
                'nama' => $data->nama,
                'harga' => $data->harga,
                'kuantitas' => $request->kuantitas,
                'subTotal' => $subTotal,
            ]);
        }

        $total = DB::table('detail_penjualans')->where('penjualan_no',$request->no)->sum('subTotal');

        return Penjualan::where('no',$request->no)->update([
            'total' => $total,
        ]);
      }
    }

    public function hapusBarang(Request $request) {
    $rules = array(
        'no' => 'required',
        'barang_id' => 'required|numeric|min:0',
      );

      $validator = Validator::make(Input::all(),$rules);

      if ($validator->fails()) {
        return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
      }
      else {
        DB::table('detail_penjualans')->where('penjualan_no',$request->no)->where('barang_id',$request->barang_id)->delete();
        
        $total = DB::table('detail_penjualans')->where('penjualan_no',$request->no)->sum('subTotal');

        return Penjualan::where('no',$request->no)->update([
            'total' => $total,
        ]);
      }
    }

    public function hapusTransaksi(Request $request) {

        Penjualan::where('no',$request->no)->delete();

        DB::table('detail_penjualans')->where('penjualan_no',$request->no)->delete();

        return redirect()->back();

    }

    public function pembelianAnggota(Request $request)
    {
        $dari = $request->dariTahun."-".$request->dariBulan."-".$request->dariTanggal;
        $sampai = $request->sampaiTahun."-".$request->sampaiBulan."-".$request->sampaiTanggal;
    
        $pembelian = DB::table('penjualans as a')
        ->join('anggotas as b','a.anggota_no','b.no')
        ->where('b.no',session('data')['no'])
        ->whereBetween('a.tanggal',[$dari,$sampai])
        ->select(
         'a.no',
         'a.tanggal',
         'a.total'
        )->get();

        $tanggal = ["dari" => $dari,"sampai" => $sampai];

        return view('pembelian',compact('pembelian','tanggal'));
    }

    public function detailPembelianAnggota(Request $request)
    {
        $detail = DetailPenjualan::where('penjualan_no',$request->no)->get();

        return response()->json($detail);
    }

    public function tagihan()
    {        
        return view('tagihan');
    }

    public function cariTagihan(Request $request)
    {
        if ($request->periode == 1)
        {
            $dari = $request->tahun - 1;
            $dari .= "-12-18";
        }

        else
        {
            $dari = $request->tahun."-";
            $dari .= $request->periode - 1;
            $dari .= "-18";
        }

        $sampai = $request->tahun."-".$request->periode."-17";

        $pembelian = Penjualan::where('anggota_no',session('data')['no'])->whereBetween('tanggal',[$dari,$sampai])->orderBy('tanggal','ASC')->get();

        $periode = $request->periode;
        $tahun = $request->tahun;

        return view('tagihan',compact('pembelian','periode','tahun'));
    }

}
