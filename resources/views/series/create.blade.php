@extends('layout')

@section('cabecalho')
Criar Série
@endsection

@section('conteudo')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="" method="POST" enctype="multipart/form-data">

        <div class="row">

            <div class="col-8">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" required/>
                </div>
            </div>

            <div class="col-2">
                <div class="form-group">
                    <label for="qtd_temporadas">Qtd Temporadas</label>
                    <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas" required/>
                </div>
            </div>


            <div class="col-2">
                <div class="form-group">
                    <label for="qtd_episodio_temporada">Epsisódios temporada</label>
                    <input type="number" class="form-control" name="qtd_episodio_temporada" id="qtd_episodio_temporada" required/>
                </div>
            </div>

        </div>


        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="foto_capa">Foto Capa</label>
                    <input type="file" class="form-control" name="foto_capa" id="foto_capa" />
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @csrf
                <button class="btn btn-success">Salvar</button>
            </div>
        </div>

    </form>
@endsection
