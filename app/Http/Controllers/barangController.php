<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class barangController extends Controller
{
    public function index() {
    	$barang = Barang::all();
        $info = session('info');

        if (isset($info)) {
            return view('admin.barang',compact('barang','info'));
        }

    	return view('admin.barang',compact('barang'));
    }

    public function tambah(Request $request) {
        $rules = array(
            'nama' => 'required',
            'harga' => 'required|numeric|min:0',
        );

        $validator = Validator::make(Input::all(),$rules);

        if ($validator->fails()) {
            return redirect('/admin/barang')->with('info',['result' => 'error','ket' => $validator->getMessageBag()->first()]);
        }
        else {
            $cek = Barang::where('nama',$request->nama)->get();
            if(count($cek)>0) {
                $barang = Barang::all();

                return redirect('/admin/barang')->with('info',['result' => 'error','ket' => 'Barang sudah terdaftar!']);
            }
            else {
                $barang = new Barang;
                    $barang->nama = ucwords($request->nama);
                    $barang->harga = $request->harga;
                $barang->save();
                $barang = Barang::all();

                return redirect('/admin/barang')->with('info',['result' => 'success','ket' => 'Barang berhasil ditambahkan!']);
            }
        }
    }

    public function update(Request $request) {
    	$rules = array(
    		'id' => 'required',
    		'nama' => 'required',
            'harga' => 'required|numeric|min:0',
    	);

    	$validator = Validator::make(Input::all(),$rules);

    	if ($validator->fails()) {
    		return redirect('/admin/barang')->with('info',['result' => 'error','ket' => $validator->getMessageBag()->first()]);
    	}
    	else {
    		$barang = Barang::find($request->id);
    			$barang->nama = ucwords($request->nama);
                $barang->harga = $request->harga;
    		$barang->save();

    		return redirect('/admin/barang')->with('info',['result' => 'success','ket' => 'Data barang berhasil diperbaharui!']);
    	}    	
    }

    public function hapus(Request $request) {
    	
    	$rules = array(
    		'id' => 'required',
    	);

    	$validator = Validator::make(Input::all(),$rules);

    	if ($validator->fails()) {
    		return redirect('/admin/barang')->with('info',['result' => 'error','ket' => $validator->getMessageBag()->first()]);
    	}
    	else {
    		$barang = Barang::find($request->id)->delete();
    		return redirect('/admin/barang')->with('info',['result' => 'success','ket' => 'Barang berhasil dihapus!']);
    	}
    }
}
