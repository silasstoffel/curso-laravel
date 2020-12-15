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
            $serie    = Serie::find($serieId);
            // Remove temporadas
            $serie->temporadas->each(function (Temporada $temporada) {
                // 1. Remove Epsodios
                $temporada->episodios->each(function (Episodio $epsodio) {
                    $epsodio->delete();
                });

                // 2. Remove a temporada depois de ter removido os filhos (epsodios)
                $temporada->delete();
            });

            // 3. Por fim, remove a série que é entidade principal
            $serieExcluida = $serie;
            $serie->delete();
        });
        return $serieExcluida;
    }

}
