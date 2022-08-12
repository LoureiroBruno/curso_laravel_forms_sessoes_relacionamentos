<x-layout>
    <x-slot:title>
        Series - Listar Itens
        </x-slot>
        <x-slot:header>
            Listar Séries
            </x-slot>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @elseif (session('warning'))
                <div class="alert alert-warning">
                    {{ session('warning') }}
                </div>
            @endif

            <a href="{{ route('createSeries') }}" class="btn btn-primary btn-sm mb-4" tabindex="-1" role="button"
                aria-disabled="true">Adicionar</a>
            <ul class="list-group">
                @foreach ($series as $serie)
                    <li class="list-group-item">
                        <div class="container">
                            <p class="descricaoSerie">Descrição:
                                <b>{{ $serie->nome }}</b>
                            </p>
                            <p class="datacCadastroSerie">Efetuado cadastro:
                                <b><i>{{ $serie->created_at }}</i></b>
                            </p>
                            <p class="datacCadastroSerie">Atualizado cadastro:
                                <b><i>{{ $serie->updated_at }}</i></b>
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
</x-layout>
