<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Anggota;
use App\Penjualan;
use App\DetailPenjualan;

class userController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        $cek = session('data');

        $anggota = Anggota::where('no',$cek['no'])->first();

        return view('profile')->with('anggota',$anggota);
    }

    public function updateProfile(Request $request)
    {
        Anggota::where('no',session('data')['no'])->update([
            'nama' => $request->nama,
            'departemen' => $request->departemen,
            'posisi' => $request->posisi
        ]);
        $anggota = Anggota::where('no',session('data')['no'])->first();

        return view('profile')->with('anggota',$anggota);        
    }

    public function pembelian()
    {
    	$cek = session('data');
   	
    	$penjualan = DB::table('penjualans as a')
    	->join('anggotas as b','a.anggota_no','b.no')
    	->where('b.no',$cek['no'])
        ->where('a.tanggal',date('Y-m-d'))
    	->select(
    		'a.no',
    		'a.tanggal',
    		'a.total'
    	)->get();

    	return view('pembelian')->with('penjualan',$penjualan);
    }

    public function detail(Request $request)
    {
        $detail = DetailPenjualan::where('penjualan_no',$request->no)->get();

        return response()->json($detail);
    }

    public function tagihan()
    {
        $cek = session('data');
    
        $penjualan = DB::table('penjualans as a')
        ->join('anggotas as b','a.anggota_no','b.no')
        ->where('b.no',$cek['no'])
        ->whereBetween('a.tanggal',[date('Y-m-18',strtotime('last Month')),date('Y-m-17')])
        ->select(
            'a.no',
            'a.tanggal',
            'a.total'
        )->get();

         return view('tagihan')->with('penjualan',$penjualan);
    }

    public function ubahPin(Request $request)
    {
        $cek = session('data');

        $anggota = Anggota::where('no',$cek['no'])->first();

        if ($request->oldPin != $anggota->pin) {
            return redirect('/error');
        }

        if ($request->newPin != $request->confirmPin) {
            return redirect('/error');
        }

        $updatePin = Anggota::where('no',$cek['no'])->update(['pin' => $request->newPin]);

        return redirect()->back();
    }
}
