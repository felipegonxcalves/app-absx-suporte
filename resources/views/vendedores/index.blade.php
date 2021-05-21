@extends('layouts.app')

@section('titulo')
    Vendedores
@endsection

@section('conteudo')
    <h1>Vendedores</h1>
    @if(session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <a class="btn btn-primary" href="{{ route('vendedores.create') }}" role="button">Novo vendedor</a>

    <table class="table mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col">Email</th>
            <th scope="col">Telefone</th>
            <th scope="col">Status</th>
            <th scope="col">Opções</th>
        </tr>
        </thead>
        <tbody>
            @foreach($vendedores as $vendedor)
                <tr>
                    <th scope="row">{{ $vendedor->id }}</th>
                    <td>{{ $vendedor->nome }}</td>
                    <td>{{ $vendedor->email }}</td>
                    <td>{{ $vendedor->telefone }}</td>
                    <td>{{ $vendedor->status }}</td>
                    <td>
                        <a href="{{ route('vendedores.edit', $vendedor->id) }}" class="btn btn-secondary btn-sm">Editar</a>
                        <a href="{{ route('vendedores.delete', ['vendedore' => $vendedor->id]) }}" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
