<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    protected $table = 'posts';
    protected $guarded = [];

    // Relasi
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
