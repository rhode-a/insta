@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📚 Liste des Matières</h2>
        <a href="{{ route('matieres.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4">
            ➕ Ajouter une matière
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
                <thead class="bg-light text-uppercase text-muted small">
                    <tr>
                        <th class="ps-3">Nom</th>
                        <th>Coefficient</th>
                        <th>Formateurs</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matieres as $matiere)
                    <tr class="border-bottom border-light-subtle hover-shadow-sm">
                        <td class="ps-3 fw-medium">{{ $matiere->nom }}</td>
                        <td>{{ $matiere->coefficient }}</td>
                        <td>
                            @foreach($matiere->formateurs as $formateur)
                                <span class="badge bg-light text-dark me-1 mb-1">{{ $formateur->nom }} {{ $formateur->prenom }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">✏️</a>
                            <form action="{{ route('matieres.destroy', $matiere->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $matieres->links() }}
    </div>
</div>
@endsection
