<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
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

    // Concat
    public function tgl()
    {
        $mulai = date('d F Y', strtotime($this->tanggal_mulai));
        $selesai = date('d F Y', strtotime($this->tanggal_selesai));
        
        return $mulai.' sd '.$selesai;
    }
}
