@extends('layouts.layout-1')

@section('title', 'Pessoas')

@section('content')
    @component('components.page-header')
        @slot('title', 'Pessoas')

        @component('components.create-btn')
            @slot('route', 'pessoas.create')
            @slot('title', 'Criar pessoa')
        @endcomponent
    @endcomponent

    <!-- Filters -->
    @component('components.filters')
        @slot('route', 'pessoas.index')

        @component('components.filter-input')
            @slot('label', 'Nome/Login')
            @slot('name', 'nome')
            @slot('value', $filters['nome'])
        @endcomponent

        @component('components.filter-select')
            @slot('label', 'Ativo')
            @slot('name', 'ativo')
            @slot('items', ['T' => 'Todos', 'S' => 'Sim', 'N' => 'Não'])
            @slot('selected_item', $filters['ativo'])
        @endcomponent
    @endcomponent
    <!-- / Filters -->

    @component('components.grid')
        <table class="table table-striped table-bordered table-hover card-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Endereço</th>             
                <th>Criado em</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($pessoas as $pessoa)
                <tr>
                    <td>{{ $pessoa->id }}</td>
                    <td>{{ $pessoa->nome }}</td>
                    <td>{{ $pessoa->email }}</td>
                    <td>{{ $pessoa->telefone_formatado }}</td>
                    <td>{{ $pessoa->endereco }}</td>                    
                    <td>{{ $pessoa->dt_criacao_formatado }}</td>
                    <td class="cell-nowrap">
                        @component('components.edit-btn')
                            @slot('route', 'pessoas.edit')
                            @slot('route_params', ['id' => $pessoa->id])
                        @endcomponent

                        @component('components.destroy-btn')
                            @slot('route', 'pessoas.destroy')
                            @slot('route_params', ['id' => $pessoa->id])
                        @endcomponent
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">
                        {{ config('app.messages.grid.no_rows') }}
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        @slot('pagination', $pessoas->appends($filters)->links())
    @endcomponent
@endsection
