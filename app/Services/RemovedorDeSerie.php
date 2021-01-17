<?php

namespace App\Services;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;
use App\Events\SerieExcluidaEvent;
use App\Jobs\ExcluirCapaSerieJob;

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

            // Emite um  evento de série excluida para os ouvintes tomarem
            // alguma ação
            $data = $serieExcluida->toArray();

            // A serie por padrão vem como array, se passar um objeto série
            // (model) depois de exluir vai dar problema se for executado por
            // um serviço de fila, por isso, está sendo feito conversão para
            // array de depois para objeto simples do PHP.
            /*
            event(
                new SerieExcluidaEvent((object) $data)
            );
            */

            ExcluirCapaSerieJob::dispatch((object) $data);

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
