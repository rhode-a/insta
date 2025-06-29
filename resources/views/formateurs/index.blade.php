@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-primary fw-bold">Liste des Formateurs</h2>

    @if(session('success'))
        <div class="alert alert-success shadow-sm rounded-3">{{ session('success') }}</div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('formateurs.create') }}" class="btn btn-success mb-4 rounded-pill px-4">
            + Ajouter un Formateur
        </a>
    @endif

    @if($formateurs->count() > 0)
        <div class="table-responsive shadow-sm rounded-3 border">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="fw-semibold">Nom</th>
                        <th class="fw-semibold">Prénom</th>
                        <th class="fw-semibold">Code</th>
                        <th class="fw-semibold">Email</th>
                        <th class="text-center fw-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formateurs as $formateur)
                    <tr>
                        <td>{{ $formateur->nom }}</td>
                        <td>{{ $formateur->prenom }}</td>
                        <td><code>{{ $formateur->matricule }}</code></td>
                        <td>{{ $formateur->email }}</td>
                        <td class="text-center">
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('formateurs.edit', $formateur) }}" class="btn btn-sm btn-outline-warning me-2 rounded-pill px-3">Modifier</a>
                                <form action="{{ route('formateurs.destroy', $formateur) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce formateur ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-pill px-3">Supprimer</button>
                                </form>
                            @else
                                <span class="text-muted fst-italic">N/A</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $formateurs->links() }}
        </div>
    @else
        <p class="text-center text-muted fst-italic">Aucun formateur trouvé.</p>
    @endif
</div>
@endsection
