<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaan';
    protected $guarded = [];

    // Relasi
    public function peserta()
    {
    	return $this->hasMany(Peserta::class);
    }

    public function pengajuan()
    {
    	return $this->belongsToMany(Pengajuan::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}
