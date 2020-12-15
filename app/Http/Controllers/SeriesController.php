<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
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

    public function store(SeriesFormRequest $request)
    {
        $serie                = Serie::create($request->all());
        $quantidadeTemporadas = (int) $request->qtd_temporadas;
        $quantidadeEpsodio    = (int) $request->qtd_episodio_temporada;
        for ($i = 1; $i <= $quantidadeTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            for ($j = 1; $j <= $quantidadeEpsodio; $j++) {
                $temporada->episodios()->create(['numero' => $j]);
            }
        }

        $request->session()
            ->flash(
                'flash_message',
                sprintf('Série %s - %s e epsódios criada com sucesso!', $serie->id, $serie->nome)
            );
        return redirect('/series');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Serie::destroy($id);
        $request->session()->flash('flash_message', 'Serie removida com sucesso');
        return redirect()->route('serie.index');
    }

}
