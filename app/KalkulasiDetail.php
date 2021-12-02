<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KalkulasiDetail extends Model
{
    protected $table = 'kalkulasi_detail';
    protected $guarded = [];

    public function material() {
        return $this->belongsTo(Material::class);
    }
}
