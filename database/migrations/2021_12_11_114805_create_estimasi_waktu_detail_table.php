<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimasiWaktuDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimasi_waktu_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('estimasi_waktu_id')->unsigned();
            $table->BigInteger('jasa_id')->unsigned();
            $table->BigInteger('harga_jasa');
            $table->BigInteger('jumlah_jasa');
            $table->BigInteger('sub_harga_jasa');
            $table->timestamps();
            $table->foreign('estimasi_waktu_id')->references('id')->on('estimasi_waktu'); 
            $table->foreign('jasa_id')->references('id')->on('jasa'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estimasi_waktu_detail');
    }
}
