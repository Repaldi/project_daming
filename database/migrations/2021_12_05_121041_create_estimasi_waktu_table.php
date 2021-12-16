<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimasiWaktuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasi_waktu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('provinsi_id')->unsigned();
            $table->BigInteger('kabupaten_id')->unsigned();
            $table->BigInteger('kecamatan_id')->unsigned();
            $table->Integer('total_jasa');
            $table->BigInteger('total_harga_jasa');
            $table->BigInteger('waktu_pengerjaan');
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
        Schema::dropIfExists('estimasi_waktu');
    }
}
