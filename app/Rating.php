<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'rating';
    protected $guarded = [];

    // Relasi
    public function perusahaan()
    {
    	return $this->belongsTo(Perusahaan::class);
    }

    public function peserta()
    {
    	return $this->belongsTo(Peserta::class);
    }
}
