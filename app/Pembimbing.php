<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbing';
    protected $guarded = [];

    // Relasi
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function peserta()
    {
    	return $this->hasMany(Peserta::class);
    }
}
