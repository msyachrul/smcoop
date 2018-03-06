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
    	$anggota = Anggota::all();

    	return view('anggota',compact('anggota'));
    }

    public function tambah(Request $req) {
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
            $cek = Anggota::where('no',$req->no)->get();

            if (count($cek) > 0) {
                return response::json(array('errors'=>'ada'));
            }
            else {
    		$anggota = new Anggota;

    			$anggota->no = $req->no;
                $anggota->nama = ucwords($req->nama);
    			$anggota->departemen = $req->departemen;
    			$anggota->posisi = ucwords($req->posisi);
                $anggota->totalSimpanan = $req->totalSimpanan;

    		$anggota->save();

    		return response()->json($anggota);
            }
    	}
    }

    public function update(Request $req) {
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
            $anggota = Anggota::find($req->id);

                $anggota->no = $req->no;
                $anggota->nama = ucwords($req->nama);
                $anggota->departemen = $req->departemen;
                $anggota->posisi = ucwords($req->posisi);
                $anggota->totalSimpanan = $req->totalSimpanan;

            $anggota->save();

            return response()->json($anggota);
        }
    }

    public function hapus(Request $req) {
        $rules = array(
            'no' => 'required',
        );
        $validator = Validator::make(input::all(),$rules);

        if ($validator->fails()) {
            return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
        }        
        else {
            $anggota = Anggota::where('no',$req->no)->delete();
            return response()->json($anggota);
        }   
    }

}
