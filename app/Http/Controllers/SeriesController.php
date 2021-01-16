<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

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

        // Faz upload para /storage/public/series
        $fotoCapa = null;
        if ($request->hasFile('foto_capa')) {
            $fotoCapa = $request->file('foto_capa')->store('/series', ['disk' => 'public']);
            //Artisan::call('storage:link');
        }
        // Tem que rodar: php artisan storage:link para criar link simbólico

        $serie = $criadorSerie->criar(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodio_temporada,
            $fotoCapa
        );

        $event = new \App\Events\SeriaCriadaEvent(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodio_temporada
        );

        event($event);

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

    public function updateName(int $id, Request $request)
    {
        $serie       = Serie::find($id);
        $serie->nome = $request->nome;
        $serie->save();
    }
}
