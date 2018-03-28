<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use Validator;
use Response;
use Illuminate\Support\Facades\input;

class anggotaController extends Controller
{

    public function index()	{
    	$anggota = Anggota::orderBy('nama','ASC')->get();

    	return view('admin.anggota',compact('anggota'));
    }

    public function tambah(Request $request) {
    	$rules = array(
            'no' => 'required',
    		'nama' => 'required',
    		'departemen' => 'required',
    		'posisi' => 'required',
            'totalSimpanan' => 'numeric|min:0',
    	);

    	$validator = Validator::make(input::all(),$rules);

    	if ($validator->fails()) {
    		return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
    	}
    	else {
            $cek = Anggota::where('no',$request->no)->get();

            if (count($cek) > 0) {
                return response::json(array('errors'=>'ada'));
            }
            else {
            $anggota = new Anggota;

    			$anggota->no = $request->no;
                $anggota->pin = rand(100000,999999);
                $anggota->nama = ucwords($request->nama);
    			$anggota->departemen = $request->departemen;
    			$anggota->posisi = ucwords($request->posisi);
                $anggota->totalSimpanan = $request->totalSimpanan;
                $anggota->admin = false;

    		$anggota->save();

    		return response()->json('Anggota berhasil ditambahkan');
            }
    	}
    }

    public function update(Request $request) {
        $rules = array(
            'no' => 'required',
            'pin' => 'required',
            'nama' => 'required',
            'departemen' => 'required',
            'posisi' => 'required',
            'totalSimpanan' => 'numeric|min:0',
        );

        $validator = Validator::make(input::all(),$rules);

        if ($validator->fails()) {
            return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
        }
        else {
            $anggota = Anggota::where('no',$request->no)->update([
                'pin' => $request->pin,
                'nama' => ucwords($request->nama),
                'departemen' => $request->departemen,
                'posisi' => ucwords($request->posisi),
                'totalSimpanan' => $request->totalSimpanan,
            ]);

            return response()->json($anggota);
        }
    }

    public function hapus(Request $request) {
        $rules = array(
            'no' => 'required',
        );
        $validator = Validator::make(input::all(),$rules);

        if ($validator->fails()) {
            return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
        }        
        else {
            $anggota = Anggota::where('no',$request->no)->delete();
            return response()->json($anggota);
        }   
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
        $info = "Data berhasil diperbaharui!";
        
        return view('profile')->with('anggota',$anggota)->with('info',$info);
    }

    public function ubahPin(Request $request)
    {
        $cek = session('data');

        $anggota = Anggota::where('no',$cek['no'])->first();

        if ($request->oldPin != $anggota->pin) {
            return response()->json(array('errors' => 'PIN lama salah!'));
        }

        if ($request->newPin != $request->confirmPin) {
            return response()->json(array('errors' => 'PIN baru tidak sama!'));
        }

        $updatePin = Anggota::where('no',$cek['no'])->update(['pin' => $request->newPin]);

        return response()->json('PIN berhasil diubah');
    }

}
