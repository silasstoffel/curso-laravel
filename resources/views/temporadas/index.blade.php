@extends('layout')

@section('cabecalho')
Temporadas de {{$serie->nome}}
@endsection

@section('conteudo')

<div class="row">
    <div class="col">
        <ul class="list-group">
            @foreach($temporadas as $temporada)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Temporada {{ $temporada->numero }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
