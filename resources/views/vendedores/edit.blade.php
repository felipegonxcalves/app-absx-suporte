@extends('layouts.app')

@section('titulo')
    Vendedores
@endsection

@section('conteudo')
    <h2>Cadastro de Vendedor</h2>

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
        <form action="{{ route('vendedores.update', ['vendedore' => $vendedor->id]) }}" method="post" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-12">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ $vendedor->nome }}">
            </div>
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $vendedor->email }}">
            </div>

            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ $vendedor->telefone }}" >
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select id="status" required="true" name="status" class="form-select">
                    <option selected>Selecione...</option>
                    <option {{ $vendedor->status == 'ativo' ? 'selected' : '' }} value="ativo">Ativo</option>
                    <option {{ $vendedor->status == 'inativo' ? 'selected' : '' }} value="inativo">Inativo</option>
                </select>
            </div>

            <div class="col-12">
                <a href="{{ route('vendedores.index') }}" class="btn btn-danger">Voltar</a>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
        </form>
    </div>


@endsection
