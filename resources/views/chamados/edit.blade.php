@extends('layouts.app')

@section('titulo', 'Chamados')

@section('conteudo')
    <h2>Editar Chamado</h2>

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mt-4">
        <form action="{{ route('chamados.update', $chamado->id_called) }}" method="post" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-12">
                <label><strong>Vendedor Responsável pelo Chamado:</strong>
                    {{ $chamado->nome_vendedor }}
                </label>
            </div>

            <div class="col-md-12">
                <label for="assunto" class="form-label">Assunto</label>
                <input type="text" class="form-control" id="assunto" name="assunto" value="{{ $chamado->assunto }}">
            </div>
            <div class="col-md-12">
                <label for="descricao" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="{{ $chamado->descricao }}">
            </div>

            <div class="col-md-6">
                <label for="dt_criacao_chamado" class="form-label">Data do Chamado</label>
                <input type="date" class="form-control" id="dt_criacao_chamado" name="dt_criacao_chamado" value="{{ $chamado->dt_criacao_chamado }}" >
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" required="true" name="status" class="form-select">
                    <option selected>Selecione...</option>
                    @foreach($status as $statu)
                        <option {{ $chamado->status == $statu->id ? 'selected' : '' }} value="{{ $statu->id }}">{{ $statu->descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <a href="{{ route('chamados.index') }}" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>


@endsection
