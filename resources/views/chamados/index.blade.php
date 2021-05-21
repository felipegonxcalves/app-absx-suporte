@extends('layouts.app')

@section('titulo')
    Chamados
@endsection

@section('conteudo')
    <h1>Chamados</h1>
    @if(session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a class="btn btn-primary" href="{{ route('chamados.create') }}" role="button">Novo Chamado</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Assunto</th>
            <th scope="col">Descrição</th>
            <th scope="col">Data criação</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
        </tr>
        </thead>
        <tbody>
            @foreach($chamados as $chamado)
                <tr>
                    <th scope="row">{{ $chamado->id_called }}</th>
                    <td>{{ $chamado->assunto }}</td>
                    <td>{{ $chamado->descricao }}</td>
                    <td>{{ $chamado->dt_criacao_chamado }}</td>
                    <td>{{ $chamado->desc_status }}</td>
                    <td>
                        <a href="{{ route('chamados.show', $chamado->id_called) }}" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="{{ route('chamados.edit', $chamado->id_called) }}" class="btn btn-primary btn-sm">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
