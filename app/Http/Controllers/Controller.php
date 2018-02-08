<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

// 

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
            'noAnggota' => 'required',
    		'nama' => 'required',
    		'departemen' => 'required',
    		'posisi' => 'required',
    	);

    	$validator = Validator::make(input::all(),$rules);

    	if ($validator->fails()) {

    		return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
    	}

    	else {
    		$anggota = new Anggota;

    			$anggota->noAnggota = $req->noAnggota;
                $anggota->nama = $req->nama;
    			$anggota->departemen = $req->departemen;
    			$anggota->posisi = $req->posisi;
                $anggota->totalSimpanan = $req->totalSimpanan;

    		$anggota->save();

    		return response()->json($anggota);
    	}

    }

    public function update(Request $req) {

        $rules = array(
            'noAnggota' => 'required',
            'nama' => 'required',
            'departemen' => 'required',
            'posisi' => 'required',
        );

        $validator = Validator::make(input::all(),$rules);

        if ($validator->fails()) {

            return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
        }

        else {
            $anggota = Anggota::find($req->id);

                $anggota->noAnggota = $req->noAnggota;
                $anggota->nama = $req->nama;
                $anggota->departemen = $req->departemen;
                $anggota->posisi = $req->posisi;
                $anggota->totalSimpanan = $req->totalSimpanan;

            $anggota->save();

            return response()->json($anggota);
        }

    }

    public function hapus(Request $req) {

        $rules = array(
            'id' => 'required',
        );

        $validator = Validator::make(input::all(),$rules);

        if ($validator->fails()) {

            return response::json(array('errors'=>$validator->getMessageBag()->toarray()));
        }        

        else {

            $anggota = Anggota::find($req->id)->delete();
            return response()->json($anggota);
        }
        
    }

    public function testLogin(Request $req) {
        $noAnggota = $req->noAnggota;
        $noPin = $req->noPin;

        if ($noAnggota == '123456789' && $noPin == '12345') {
            return view('user');
        }

        elseif ($noAnggota == 'admin' && $noPin == 'admin') {
            return redirect('anggota');
        }

        else {
            return redirect('login');
        }

    }

}
