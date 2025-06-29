@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des Niveaux</h2>

    <a href="{{ route('niveaux.create') }}" class="btn btn-success mb-3">Ajouter un niveau</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($niveaux as $niveau)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $niveau->nom }}</td>
                    <td>
                        <a href="{{ route('niveaux.show', $niveau) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('niveaux.edit', $niveau) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('niveaux.destroy', $niveau) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
