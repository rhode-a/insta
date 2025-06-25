@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Liste des Étudiants</h2>
    <a href="{{ route('etudiants.create') }}" class="btn btn-primary mb-3">Ajouter un Étudiant</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Matricule</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Option</th>
                <th>Niveau</th>
                <th>Moyenne</th>
                <th>Mention</th>
                @if(auth()->user()->role === 'admin')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($etudiants as $etudiant)
            <tr>
                <td>{{ $etudiant->matricule }}</td>
                <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                <td>{{ $etudiant->email }}</td>
                <td>{{ $etudiant->telephone ?? '-' }}</td>
                <td>{{ $etudiant->option->nom ?? '-' }}</td>
                <td>{{ $etudiant->niveau->nom ?? '-' }}</td>
                <td>{{ number_format($etudiant->moyenne(), 2) }}</td>
                <td>{{ $etudiant->mention() }}</td>
                @if(auth()->user()->role === 'admin')
                <td>
                    <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr><td colspan="9" class="text-center">Aucun étudiant trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $etudiants->links() }}
</div>
@endsection
