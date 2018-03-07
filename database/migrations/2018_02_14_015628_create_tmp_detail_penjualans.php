<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpDetailPenjualans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_detail_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('barang_id');
            $table->string('nama',30);
            $table->integer('harga');
            $table->integer('kuantitas');
            $table->integer('subTotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_detail_penjualans');
    }
}
