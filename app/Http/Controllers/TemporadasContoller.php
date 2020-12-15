<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class TemporadasContoller extends Controller
{
    public function index($serieId)
    {
        $serie = Serie::find($serieId);
        $temporadas = $serie->temporadas;
        return view('temporadas.index', compact('temporadas', 'serie'));
    }
}
