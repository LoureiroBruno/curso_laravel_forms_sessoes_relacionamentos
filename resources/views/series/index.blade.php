<x-layout>
    <x-slot:title>
        Series - Listar Itens
        </x-slot>
        <x-slot:header>
            Listar Séries
            </x-slot>

            <a href="{{ route('series.create') }}" class="btn btn-primary btn-sm mb-4" tabindex="-1" role="button"
                aria-disabled="true">Adicionar</a>

            <table class="table table-hover">
                <thead class="thead-tabela-series-topo">
                    <tr class="th-tabela-series">
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Data de Inscrição</th>
                        <th scope="col">Data de Edição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($series as $serie)
                        <tr>
                            <th scope="row">{{ $serie->id }}</th>
                            <td>{{ $serie->nome }}</td>
                            <td>
                                <button type="button" class="btn btn-link">
                                    <img src="{{ asset('img/detalhes.svg') }}" />
                                </button>
                            </td>
                            <td>{{ $serie->created_at }}</td>
                            <td>{{ $serie->updated_at }}</td>
                            <td class="td-coluna-acoes-tabela-series">
                                <div>
                                    <form action="{{ route('series.edit', $serie->id) }}" method="get" id="btn-update">
                                        @csrf
                                        @method('EDIT')
                                        <button type="submit" class="btn btn-outline-dark btn-sm mb-1 ms-1">
                                            Editar
                                        </button>
                                    </form>

                                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" id="btn-destroy">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mb-1">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <thead class="thead-tabela-series-footer">
                    <tr class="th-tabela-series">
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Data de Inscrição</th>
                        <th scope="col">Data de Edição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
            </table>
</x-layout>
