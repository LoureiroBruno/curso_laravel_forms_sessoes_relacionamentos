<form action={{ $action }} method="POST">
    @csrf
    @isset($nome)
        @method('PUT')
    @endisset

    <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome de Descrição Série"
            @isset($nome) value="{{ $nome }}" @endisset>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-outline-primary btn-sm mb-3">Salvar</button>
        <a href="{{ route('series.index') }}" class="btn btn-outline-danger btn-sm mb-3 ms-2" tabindex="-1"
            role="button" aria-disabled="true">Cancelar</a>
    </div>
</form>
