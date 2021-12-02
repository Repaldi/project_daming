<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalkulasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalkulasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('kode_kalkulasi');
            $table->BigInteger('provinsi_id')->unsigned();
            $table->BigInteger('kabupaten_id')->unsigned();
            $table->BigInteger('kecamatan_id')->unsigned();
            $table->BigInteger('tipe_bangunan_id')->unsigned();
            $table->Integer('total_material');
            $table->BigInteger('total_harga');
            $table->timestamps();
            $table->foreign('provinsi_id')->references('id')->on('provinsi'); 
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten'); 
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan'); 
            $table->foreign('tipe_bangunan_id')->references('id')->on('tipe_bangunan'); 
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kalkulasi');
    }
}
