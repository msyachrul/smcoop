<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anggota;
use Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $anggota = Anggota::where(['no' => $request->no, 'pin' => $request->pin])->first();

        if ($anggota != null) {

            $data = [
                'no' => $anggota->no,
                'nama' => $anggota->nama,
                'admin' => $anggota->admin,
            ];

            $request->session()->put('data',$data);

            if ($anggota->admin == true) {
                return redirect('/admin/');
            }

            return redirect('/');

        }

        return redirect()->back()->withErrors('No Anggota atau PIN tidak benar!');
        
    }

    public function logout(Request $request) {
        $request->session()->flush();

        return redirect('/masuk');
    }
}
