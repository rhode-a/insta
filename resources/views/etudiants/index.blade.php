@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📋 Liste des Étudiants</h2>
        <a href="{{ route('etudiants.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4">
            ➕ Ajouter un Étudiant
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="bg-white rounded-4 shadow p-3 p-md-4">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-3">Matricule</th>
                        <th>Nom complet</th>
                        <th>Téléphone</th>
                        <th>Option</th>
                        <th>Niveau</th>
                        <th>Moyenne</th>
                        <th>Mention</th>
                        @if(auth()->user()->role === 'admin')
                        <th class="text-center">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etudiant)
                    <tr class="border-bottom border-light-subtle hover-shadow-sm">
                        <td class="ps-3 fw-medium">{{ $etudiant->matricule }}</td>
                        <td>{{ $etudiant->prenom }} {{ $etudiant->nom }}</td>
                        <td>{{ $etudiant->telephone ?? '-' }}</td>
                        <td>{{ $etudiant->option->nom ?? '-' }}</td>
                        <td>{{ $etudiant->niveau->nom ?? '-' }}</td>
                        <td>{{ number_format($etudiant->moyenne(), 2) }}</td>
                        <td>{{ $etudiant->mention() }}</td>
                        @if(auth()->user()->role === 'admin')
                        <td class="text-center">
                            <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">✏️</a>
                            <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">🗑️</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Aucun étudiant trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $etudiants->links() }}
    </div>
</div>
@endsection
