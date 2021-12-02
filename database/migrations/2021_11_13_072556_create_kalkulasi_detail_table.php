<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKalkulasiDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kalkulasi_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->BigInteger('kalkulasi_id')->unsigned();
            $table->BigInteger('material_id')->unsigned();
            $table->string('satuan_material');
            $table->Integer('banyak_material');
            $table->BigInteger('sub_harga_material');
            $table->timestamps();
            $table->foreign('kalkulasi_id')->references('id')->on('kalkulasi'); 
            $table->foreign('material_id')->references('id')->on('material'); 
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kalkulasi_detail');
    }
}
