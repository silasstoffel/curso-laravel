<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use App\Models\User;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $serie = $criadorSerie->criar(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodio_temporada
        );

        $this->alertarUsuariosPorEmailAoCriarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->qtd_episodio_temporada
        );

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

    private function alertarUsuariosPorEmailAoCriarSerie($nome, $quantidadeTemporada, $quantidadeEpsodio)
    {
        /*
        | 1. Rodar os jobs com uma tentativa:
        | php artisan queue:listen --tries=1
        |
        | 2. Colocar os jobs com falha na fila para executar (por ID ou todos)
        | php artisan queue:retry [1|all]
        */
        $usuarios = User::all();
        foreach ($usuarios as $k => $usuario) {
            $email = new \App\Mail\SerieCriada(
                $nome,
                $quantidadeTemporada,
                $quantidadeEpsodio
            );
            Mail::to($usuario)->queue($email);
        }
    }

}
