<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenjualansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->string('no',30)->primary();
            $table->date('tanggal');
            $table->bigInteger('total');
            $table->timestamps();
        });

        Schema::table('penjualans', function (Blueprint $table) {
            $table->string('anggota_no');
            $table->foreign('anggota_no')->references('no')->on('anggotas')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjualans');
    }
}
