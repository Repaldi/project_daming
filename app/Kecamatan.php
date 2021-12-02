<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = 'kecamatan';
    protected $guarded = [];

    public function provinsi() {
        return $this->belongsTo(Provinsi::class);
    }

    public function kabupaten() {
        return $this->belongsTo(Provinsi::class);
    }
}
