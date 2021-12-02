<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipeBangunanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipe_bangunan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_tipe_bangunan');
            $table->BigInteger('provinsi_id')->unsigned();
            $table->BigInteger('kabupaten_id')->unsigned();
            $table->BigInteger('kecamatan_id')->unsigned();
            $table->timestamps();
            $table->foreign('provinsi_id')->references('id')->on('provinsi'); 
            $table->foreign('kabupaten_id')->references('id')->on('kabupaten'); 
            $table->foreign('kecamatan_id')->references('id')->on('kecamatan'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipe_bangunan');
    }
}
