<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grup extends Model
{
    protected $table = 'grup';
    protected $guarded = [];

    // Relasi
    public function peserta()
    {
    	return $this->hasMany(Peserta::class);
    }
}
