
@if (!empty($mensagem))
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
