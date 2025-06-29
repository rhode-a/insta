@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📘 Liste des Cours</h2>
        <a href="{{ route('cours.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4">
            ➕ Ajouter un cours
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
                        <th class="ps-3">Intitulé</th>
                        <th>Matière</th>
                        <th>Formateur</th>
                        <th>Option</th>
                        <th>Heures</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($cours as $cour)
                    <tr class="border-bottom border-light-subtle">
                        <td class="ps-3 fw-medium">{{ $cour->intitule }}</td>
                        <td>{{ $cour->matiere->nom ?? '-' }}</td>
                        <td>{{ $cour->formateur->nom ?? '-' }} {{ $cour->formateur->prenom ?? '' }}</td>
                        <td>{{ $cour->option->nom ?? '-' }}</td>
                        <td>{{ $cour->nombre_heures }}</td>
                        <td>{{ $cour->date->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <a href="{{ route('cours.edit', $cour->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                ✏️
                            </a>
                            <form action="{{ route('cours.destroy', $cour->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                    🗑️
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Aucun cours trouvé.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $cours->links() }}
    </div>
</div>
@endsection
