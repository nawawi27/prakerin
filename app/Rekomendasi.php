<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    protected $table = 'rekomendasi_perusahaan';
    protected $guarded = [];

    // Relasi
    public function peserta()
    {
    	return $this->belongsTo(Peserta::class);
    }
}
