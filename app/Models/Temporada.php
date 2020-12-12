<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table    = 'temporada';
    protected $fillable = ['nome'];

    public function epsodios() {
        return $this->hasMany(Epsodios::class);
    }

    public function serie() {
        return $this->belongsTo(Serie::class);
    }
}
