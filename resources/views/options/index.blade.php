{{-- resources/views/options/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des Options</h2>

    <a href="{{ route('options.create') }}" class="btn btn-success mb-3">Ajouter une Option</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($options as $option)
                <tr>
                    <td>{{ $option->id }}</td>
                    <td>{{ $option->nom }}</td>
                    <td>
                        <a href="{{ route('options.edit', $option->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('options.destroy', $option->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Confirmer la suppression ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucune option enregistrée.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
