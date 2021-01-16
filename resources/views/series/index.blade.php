@extends('layout')

@section('cabecalho')
Séries
@endsection

@section('conteudo')

@auth
<a href="{{ route('serie_create') }}" class="btn btn-dark mb-2">Adicionar</a>
@endauth

@include('flash-message', ['mensagem' => $mensagem])

<div class="row">
    <div class="col">
        <ul class="list-group">
            @foreach($series as $serie)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">

                        <div>
                            <img src="{{ $serie->foto_capa }}" class="img-thumbnail mr-2" height="100px" width="100px"/>
                            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                        </div>

                        <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                            <input type="text" class="form-control" value="{{ $serie->nome }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>


                        <span class="d-flex">

                            @auth
                            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                             @endauth

                            <a href="/series/{{ $serie->id }}/temporadas" class="btn btn-info btn-sm mr-2">
                                <i class="fas fa-external-link-alt"></i>
                            </a>

                            @auth
                            <form method="post" action="series/remove/{{ $serie->id }}" onsubmit="return confirm('Deseja excluir?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endauth
                        </span>

                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>


<script>
    function toggleInput(serieId) {
        const nomeSerieEl = document.getElementById(`input-nome-serie-${serieId}`);
        const inputSerieEl = document.getElementById(`nome-serie-${serieId}`);
        if (nomeSerieEl.hasAttribute('hidden')) {
            nomeSerieEl.removeAttribute('hidden');
            inputSerieEl.hidden = true;
        } else {
            inputSerieEl.removeAttribute('hidden');
            nomeSerieEl.hidden = true;
        }
    }

    function editarSerie(serieId) {
        const nome = document.querySelector(`#input-nome-serie-${serieId} > input`).value;
        const token = document.querySelector('input[name="_token"]').value;
        let form = new FormData();
        form.append('nome', nome);
        form.append('_token', token);
        const url = `/series/${serieId}/editar-nome`

        fetch(url, {
            body: form,
            method: 'post'
        }).then(() => {
            toggleInput(serieId);
            document.querySelector(`#nome-serie-${serieId}`).textContent = nome;
        });
    }

</script>

@endsection
