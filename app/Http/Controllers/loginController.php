<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class loginController extends Controller
{
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
