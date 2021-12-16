<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimasiWaktuDetail extends Model
{
    protected $table = 'estimasi_waktu_detail';
    protected $guarded = [];

    public function jasa() {
        return $this->belongsTo(Jasa::class);
    }
}
