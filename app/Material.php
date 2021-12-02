<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';
    protected $guarded = [];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class);
    }
    public function kabupaten(){
        return $this->belongsTo(Kabupaten::class);
    }
    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class);
    }
}
