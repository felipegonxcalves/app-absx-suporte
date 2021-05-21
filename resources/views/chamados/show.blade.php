@extends('layouts.app')

@section('titulo')
    Chamados
@endsection

@section('conteudo')
    <h1>Chamado - {{ $chamado->id_called }}</h1>

    <ul class="list-group">
        <li class="list-group-item"><strong>Assunto chamado:</strong> {{ $chamado->assunto }}</li>
        <li class="list-group-item"><strong>Descrição chamado:</strong> {{ $chamado->descricao }}</li>
        <li class="list-group-item"><strong>Data abertura chamado:</strong> {{ $chamado->dt_criacao_chamado }}</li>
        <li class="list-group-item"><strong>Status do chamado:</strong> {{ $chamado->desc_status }}</li>
        <li class="list-group-item"><strong>Vendedor responsável pelo chamado:</strong> {{ $chamado->nome_vendedor }}</li>
    </ul>

    <a href="{{ route('chamados.index') }}" class="btn btn-danger">Voltar</a>
@endsection
