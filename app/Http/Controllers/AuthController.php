<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use Validator;
use Illuminate\Support\Facades\input;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $anggota = Anggota::where('no',$request->no)->first();

        if ($anggota != null) {

            $data = [
                'no' => $anggota->no,
                'nama' => $anggota->nama,
            ];

            $request->session()->put('data',$data);

            return redirect('/admin/');

        }

        return redirect()->back()->withErrors('No Anggota atau PIN tidak benar!');
        
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/masuk');
    }
}
