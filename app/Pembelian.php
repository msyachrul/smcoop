<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelians';

    protected $fillable = [
    	'tanggal','harga','kuantitas','barang_id',
    ];
}
