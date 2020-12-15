<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{

    public function index(Request $request)
    {
        $series   = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('flash_message');
        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorSerie)
    {
        $serie = $criadorSerie->criar($request->nome, $request->qtd_temporadas, $request->qtd_episodio_temporada);
        $request->session()
            ->flash(
                'flash_message',
                sprintf('Série %s - %s e epsódios criada com sucesso!', $serie->id, $serie->nome)
            );
        return redirect('/series');
    }

    public function destroy(Request $request)
    {
        $serie = Serie::find($request->id);

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
        $serie->delete();

        $request->session()->flash(
            'flash_message',
            sprintf('Serie [%s - %s] removida com sucesso', $serie->id, $serie->nome)
        );
        return redirect()->route('serie.index');
    }

}
