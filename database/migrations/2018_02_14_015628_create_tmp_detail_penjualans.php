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
            $table->integer('kuantitas');
            $table->bigInteger('subTotal');
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
