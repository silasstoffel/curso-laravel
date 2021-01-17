<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table    = 'serie';
    protected $fillable = ['nome', 'foto_capa'];

    public function getFotoCapaUrlAttribute()
    {
        return (is_null($this->foto_capa)) ? '/storage/no-img.gif' : '/storage/' . $this->foto_capa;
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }
}
