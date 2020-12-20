<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function index(Temporada $temporada, Request $request)
    {
        $episodios   = $temporada->episodios;
        $temporadaId = $temporada->id;
        $mensagem = $request->session()->get('flash_message');
        return view(
            'episodios.index',
            compact('episodios', 'temporadaId', 'mensagem')
        );
    }

    public function watch(Temporada $temporada, Request $request)
    {
        $assistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio) use ($assistidos) {
            $episodio->assistido = in_array(
                $episodio->id,
                $assistidos
            );
        });
        $temporada->push();

        $request->session()
            ->flash(
                'flash_message',
                sprintf('Epsidios da temporada %s marcada como assistido!', $temporada->numero)
            );

        return redirect()->back();
    }

}
