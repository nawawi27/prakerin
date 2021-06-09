<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $table = 'peserta';
    protected $guarded = [];

    // Relasi
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function grup()
    {
        return $this->belongsTo(Grup::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function rekomendasi()
    {
        return $this->hasOne(Peserta::class);
    }

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    // Concat
    public function tgl()
    {
        $mulai = date('d F Y', strtotime($this->tanggal_mulai));
        $selesai = date('d F Y', strtotime($this->tanggal_selesai));
        
        return $mulai.' sd '.$selesai;
    }
}
