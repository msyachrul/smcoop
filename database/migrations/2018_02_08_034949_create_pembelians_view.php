<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembeliansView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE VIEW pembelians_view as 
            SELECT a.id, a.tanggal, b.id as barang_id, b.nama, a.harga, a.kuantitas
            FROM pembelians a, barangs b 
            WHERE a.barang_id = b.id');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW pembelians_view');
    }
}
