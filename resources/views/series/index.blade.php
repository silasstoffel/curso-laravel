@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')
<a href="{{ route('serie_create') }}" class="btn btn-dark mb-2">Adicionar</a>

@if ($mensagem)
    <div class="row">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $mensagem }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col">
        <ul class="list-group">
            @foreach($series as $serie)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>{{ $serie->nome }}</span>
                        <span class="d-flex">
                            <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-2">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <form method="post" action="series/remove/{{ $serie->id }}" onsubmit="return confirm('Deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
