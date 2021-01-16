<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table    = 'serie';
    protected $fillable = ['nome', 'foto_capa'];

    public function getFotoCapaAttribute($foto)
    {
        return (is_null($foto)) ? '/storage/no-img.gif' : '/storage/' . $foto;
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
