@extends('layout')

@section('cabecalho')
Episodios
@endsection

@section('conteudo')

@include('flash-message', ['mensagem' => $mensagem])

<div class="row">
    <div class="col">
        <form action="/temporadas/{{$temporadaId}}/episodios/assistir" method="post">
            @csrf
            <ul class="list-group">
                @foreach($episodios as $episodio)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Episodio {{ $episodio->numero }}</span>
                            <input type="checkbox" name="episodios[]" value="{{$episodio->id}}" {{ $episodio->assistido ? "checked" : null }} />
                        </div>
                    </li>
                @endforeach
            </ul>

            <div class="mt-3 mb-3">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>

        </form>
    </div>
</div>
@endsection
