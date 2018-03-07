<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_penjualans', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('barang_id');
            $table->string('nama',30);
            $table->integer('harga');
            $table->integer('kuantitas');
            $table->integer('subTotal');
        });

        Schema::table('detail_penjualans', function (Blueprint $table) {
            $table->string('penjualan_no',30);
            $table->foreign('penjualan_no')->references('no')->on('penjualans')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_penjualans');
    }
}
