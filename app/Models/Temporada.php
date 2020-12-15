<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected $table    = 'temporada';
    protected $fillable = ['numero', 'serie_id'];

    public function episodios() {
        return $this->hasMany(Episodio::class);
    }

    public function serie() {
        return $this->belongsTo(Serie::class);
    }
}
