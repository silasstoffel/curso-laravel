@extends('layout')

@section('cabecalho')
Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')

<div class="row">
    <div class="col mb-3 text-center">
        <a href="{{ $serie->foto_capa }}" target="_blank">
            <img src="{{ $serie->foto_capa }}" class="img-thumbnail mr-2" height="400px" width="400px"/>
        </a>
    </div>
</div>

<div class="row">
    <div class="col">
        <ul class="list-group">
            @foreach($temporadas as $temporada)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="/temporadas/{{ $temporada->id }}/episodios">Temporada {{ $temporada->numero }}</a>
                        <span class="badge badge-secondary">{{ $temporada->getEpisodiosAssistidos()->count() }} / {{ $temporada->episodios->count()}}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
