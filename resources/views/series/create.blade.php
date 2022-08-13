<x-layout>
    <x-slot:title>
        Series - Cadastrar Item
        </x-slot>
        <x-slot:header>
            Nova Série
            </x-slot>

            <x-series.form action="{{ route('series.store') }}" />
</x-layout>
