<form action={{ $action }} method="POST">
    @csrf
        @if ($update)
            @method('PUT')
        @endif

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome de Descrição Série"
            @isset($nome) value="{{ $nome }}" @endisset>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary btn-sm mb-3" title="Salvar">
            <img src="{{ asset('img/send.svg') }}"/>
            Salvar
        </button>
        <a href="{{ route('series.index') }}" class="btn btn-outline-danger btn-sm mb-3 ms-2" tabindex="-1"
            role="button" aria-disabled="true" title="Cancelar">
            <img src="{{ asset('img/x-lg.svg') }}"/>
            Cancelar
        </a>
    </div>
</form>
