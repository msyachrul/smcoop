<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Anggota;
use App\Penjualan;
use App\DetailPenjualan;

class userController extends Controller
{

    // public function profile()
    // {
    //     $cek = session('data');

    //     $anggota = Anggota::where('no',$cek['no'])->first();

    //     return view('profile')->with('anggota',$anggota);
    // }

    // public function updateProfile(Request $request)
    // {
    //     Anggota::where('no',session('data')['no'])->update([
    //         'nama' => $request->nama,
    //         'departemen' => $request->departemen,
    //         'posisi' => $request->posisi
    //     ]);
    //     $anggota = Anggota::where('no',session('data')['no'])->first();
    //     $info = "Data berhasil diperbaharui!";
        
    //     return view('profile')->with('anggota',$anggota)->with('info',$info);
    // }

    // public function pembelian()
    // {
    // 	return view('pembelian');
    // }

    // public function daftarPembelian(Request $request)
    // {
    //     $cek = session('data');

    //     $tanggal = [ 'dari' => $request->dari, 'sampai' => $request->sampai ];
    
    //     $pembelian = DB::table('penjualans as a')
    //     ->join('anggotas as b','a.anggota_no','b.no')
    //     ->where('b.no',$cek['no'])
    //     ->whereBetween('a.tanggal',[$request->dari,$request->sampai])
    //     ->select(
    //      'a.no',
    //      'a.tanggal',
    //      'a.total'
    //     )->get();

    //     return view('pembelian')->with('pembelian',$pembelian)->with('tanggal',$tanggal);
    // }

    // public function detail(Request $request)
    // {
    //     $detail = DetailPenjualan::where('penjualan_no',$request->no)->get();

    //     return response()->json($detail);
    // }

    public function tagihan()
    {
        $cek = session('data');
    
        $pembelian = DB::table('penjualans as a')
        ->join('anggotas as b','a.anggota_no','b.no')
        ->where('b.no',$cek['no'])
        ->whereBetween('a.tanggal',[date('Y-m-18',strtotime('last Month')),date('Y-m-17')])
        ->select(
            'a.no',
            'a.tanggal',
            'a.total'
        )->get();

         return view('tagihan')->with('pembelian',$pembelian);
    }

    // public function ubahPin(Request $request)
    // {
    //     $cek = session('data');

    //     $anggota = Anggota::where('no',$cek['no'])->first();

    //     if ($request->oldPin != $anggota->pin) {
    //         return response()->json(array('errors' => 'PIN lama salah!'));
    //     }

    //     if ($request->newPin != $request->confirmPin) {
    //         return response()->json(array('errors' => 'PIN baru tidak sama!'));
    //     }

    //     $updatePin = Anggota::where('no',$cek['no'])->update(['pin' => $request->newPin]);

    //     return response()->json('PIN berhasil diubah');
    // }
}
