<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
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

    public function destroy(Request $request, RemovedorDeSerie $removedor)
    {
        $serie = $removedor->remover($request->id);
        $request->session()->flash(
            'flash_message',
            sprintf('Serie [%s - %s] removida com sucesso', $serie->id, $serie->nome)
        );
        return redirect()->route('serie.index');
    }

}
