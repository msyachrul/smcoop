<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualans';

    protected $fillable = [
    	'penjualan_no', 'barang_id', 'nama', 'harga', 'kuantitas', 'subTotal'
    ];

    public $timestamps = false;
}
