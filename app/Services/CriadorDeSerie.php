<?php

namespace App\Services;

use App\Models\Serie;

class CriadorDeSerie
{

    public function criar(string $nome, int $quantidadeTemporadas, int $quantidadeEpsodios): Serie
    {
        $serie                = Serie::create(['nome' => $nome]);
        for ($i = 1; $i <= $quantidadeTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            for ($j = 1; $j <= $quantidadeEpsodios; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }
        return $serie;
    }

}
