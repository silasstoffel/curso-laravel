<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodio extends Model
{
    protected $table = 'episodio';
    protected $fillable = ['numero', 'temporada_id'];

    public function temporada()
    {
        return $this->belongsTo(Temporada::class);
    }
}
