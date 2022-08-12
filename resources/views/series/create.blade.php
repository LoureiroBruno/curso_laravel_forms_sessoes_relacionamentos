<x-layout>
    <x-slot:title>
        Series - Cadastrar Item
        </x-slot>
        <x-slot:header>
            Nova Série
            </x-slot>

            <form action="{{ route('storeSeries') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="nome" class="form-control" id="nome" name="nome" placeholder="Nome do Título da Série">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary btn-sm mb-3">Salvar</button>
                    <a href="{{ route('indexSeries') }}" class="btn btn-danger btn-sm mb-3" tabindex="-1" role="button"
                    aria-disabled="true">Cancelar</a>
                </div>

            </form>
</x-layout>
