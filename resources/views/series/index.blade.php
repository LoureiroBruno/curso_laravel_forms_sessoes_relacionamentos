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
            @elseif (session('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif

            {{-- @if(session('success') || session('warning') || session('danger'))
                <div class="alert alert-{{ session('success') }} {{ session('warning') }} {{ session('danger') }}">
                    {{ session('success') }} {{ session('warning') }} {{ session('danger') }}
                </div>
            @endif --}}


            <a href="{{ route('series.create') }}" class="btn btn-primary mb-4" tabindex="-1" role="button"
                aria-disabled="true">Adicionar</a>

            <table class="table table-hover">
                <thead class="thead-tabela-series-topo">
                    <tr class="th-tabela-series">
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Inscrito</th>
                        <th scope="col">Atualizado</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($series as $serie)
                        <tr>
                            <th scope="row">{{ $serie->id }}</th>
                            <td>{{ $serie->nome }}</td>
                            <td>{{ $serie->created_at }}</td>
                            <td>{{ $serie->updated_at }}</td>
                            <td class="td-coluna-acoes-tabela-series">
                                <div>

                                    <form action="{{ route('series.destroy', $serie->id) }}" method="post" id="btn-destroy">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm mb-1">
                                            Excluir
                                        </button>
                                    </form>

                                    <form  action="" method="post" id="btn-update">
                                        @csrf
                                        {{-- @method('EDIT') --}}
                                        <button type="submit" class="btn btn-outline-dark btn-sm mb-1">
                                            Editar
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
                        <th scope="col">Inscrito</th>
                        <th scope="col">Atualizado</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
            </table>
</x-layout>
