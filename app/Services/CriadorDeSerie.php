<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{

    public function criar(string $nome, int $quantidadeTemporadas, int $quantidadeEpsodios): ?Serie
    {
        $serieCriada = null;
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nome]);
        $this->criarTemporadas($serie, $quantidadeTemporadas, $quantidadeEpsodios);
        $serieCriada = $serie;
        Db::commit();
        return $serieCriada;
    }

    private function criarTemporadas(Serie $serie, int $quantidadeTemporadas, int $quantidadeEpsodios)
    {
        for ($i = 1; $i <= $quantidadeTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($temporada, $quantidadeEpsodios);
        }
    }

    private function criarEpisodios(Temporada $temporada, int $quantidadeEpsodios)
    {
        for ($j = 1; $j <= $quantidadeEpsodios; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }

}
