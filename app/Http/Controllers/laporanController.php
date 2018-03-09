<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\DetailPenjualan;
use Illuminate\Support\Facades\DB;

class laporanController extends Controller
{
    public function index()
    {
    	return view('admin.laporan');
    }

    public function cari(Request $request)
    {    	
        $tanggal = ['dari'=>$request->dari,'sampai'=>$request->sampai];

        if(empty($request->anggota_no))
        {
            $anggota = 'Semua';
            $penjualan = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->orderBy('tanggal','ASC')->get();
            $transaksi = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->count('no');
            $nominal = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->sum('total');
        }

        else
        {
            $anggota = DB::table('penjualans as a')->join('anggotas as b','a.anggota_no','b.no')->where('a.anggota_no',$request->anggota_no)->select('b.nama')->first()->nama;
            $penjualan = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->where('anggota_no',$request->anggota_no)->orderBy('tanggal','ASC')->get();
            $transaksi = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->where('anggota_no',$request->anggota_no)->count('no');
            $nominal = Penjualan::whereBetween('tanggal',[$tanggal['dari'],$tanggal['sampai']])->where('anggota_no',$request->anggota_no)->sum('total');
        }

    	return view('admin.laporan')->with('anggota',$anggota)->with('tanggal',$tanggal)->with('penjualan',$penjualan)->with('transaksi',$transaksi)->with('nominal',$nominal);
    }

    public function detail(Request $request)
    {
        $detail = DetailPenjualan::where('penjualan_no',$request->no)->get();

        return response()->json($detail);
    }
}
