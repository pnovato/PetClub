@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Adicionar Novo Pet</h2>
    <form action="{{ route('admin.pets.store') }}" method="POST" enctype="multipart/form-data" class="mb-5">
    @csrf
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="species">Espécie</label>
            <input type="text" name="species" id="species" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="sex">Sexo</label>
            <select name="sex" id="sex" class="form-control" required>
                <option value="male">Macho</option>
                <option value="female">Fêmea</option>
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label for="age_years">Idade (anos)</label>
            <input type="number" name="age_years" id="age_years" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label for="size">Tamanho</label>
            <select name="size" id="size" class="form-control" required>
                <option value="small">Pequeno</option>
                <option value="medium">Médio</option>
                <option value="large">Grande</option>
            </select>
        </div>

        <div class="col-md-12 mb-3">
            <label for="description">Descrição</label>
            <textarea name="description" id="description" rows="3" class="form-control" required></textarea>
        </div>

        <div class="col-md-6 mb-3">
            <label for="image">Imagem (opcional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Pet</button>
        </form>
            <h2>Pets Disponíveis para Adoção</h2> 
            @if ($availablePets->isEmpty())
                    <p class="text-muted">Nenhum pet disponível no momento.</p>
                @else
            <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Espécie</th>
                            <th>Sexo</th>
                            <th>Idade</th>
                            <th>Tamanho</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
            <tbody>
            @foreach ($availablePets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ $pet->sex }}</td>
                    <td>{{ $pet->age_years }} anos</td>
                    <td>{{ $pet->size }}</td>
                    <td>{{ $pet->status }}</td>
                    <td>
                        <a href="{{ route('admin.pets.edit', $pet->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.pets.destroy', $pet->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Remover</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
                <div class="d-flex justify-content-center mt-4">
                    {{ $availablePets->links() }}
                </div> 
            </table>
            @endif
    <h3 class="mt-5">Pedidos Pendentes de Adoção</h3>
            @if ($pendingPets->isEmpty())
                <p class="text-muted">Sem pedidos pendentes.</p>
            @else
        <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Espécie</th>
                        <th>Adotado por</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            <tbody>
            @foreach($pendingPets as $pet)
                <tr>
                    <td>{{ $pet->name }}</td>
                    <td>{{ $pet->species }}</td>
                    <td>{{ $pet->adopter->name ?? 'Desconhecido' }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.pets.approve', $pet->id) }}" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button class="btn btn-success btn-sm">Aprovar</button>
                        </form>
                        <form method="POST" action="{{ route('admin.pets.reject', $pet->id) }}" style="display:inline;">
                            @csrf
                            @method('POST')
                            <button class="btn btn-danger btn-sm">Rejeitar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>
@endif
@endsection
