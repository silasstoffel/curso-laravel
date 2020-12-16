<?php

namespace App\Services;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{

    public function remover(int $serieId): ?Serie
    {
        $serieExcluida = null;
        DB::transaction(function () use ($serieId, &$serieExcluida) {
            $serie = Serie::find($serieId);
            $this->removerTemporadas($serie);
            // Por fim, remove a série que é entidade principal
            $serieExcluida = $serie;
            $serie->delete();
        });
        return $serieExcluida;
    }

    private function removerTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada) {
            // 1. Remove Epsodios
            $this->removerEpisodios($temporada);
            // 2. Remove a temporada depois de ter removido os filhos (epsodios)
            $temporada->delete();
        });
    }

    private function removerEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function (Episodio $epsodio) {
            $epsodio->delete();
        });
    }

}
