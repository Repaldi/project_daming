<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'kabupaten';
    protected $guarded = [];

    public function provinsi() {
        return $this->belongsTo(Provinsi::class);
    }
}
