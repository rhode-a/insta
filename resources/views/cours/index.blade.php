@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des Cours</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('cours.create') }}" class="btn btn-primary mb-3">Ajouter un cours</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Intitulé</th>
                <th>Matière</th>
                <th>Formateur</th>
                <th>Option</th>
                <th>Nombre d'heures</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cours as $cour)
                <tr>
                    <td>{{ $cour->intitule }}</td>
                    <td>{{ $cour->matiere->nom ?? '-' }}</td>
                    <td>{{ $cour->formateur->nom ?? '-' }} {{ $cour->formateur->prenom ?? '' }}</td>
                    <td>{{ $cour->option->nom ?? '-' }}</td>
                    <td>{{ $cour->nombre_heures }}</td>
                    <td>{{ $cour->date->format('d/m/Y') }}
</td>
                    <td>
                        <a href="{{ route('cours.edit', $cour->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <!-- Suppression par admin seulement, à adapter -->
                        <form action="{{ route('cours.destroy', $cour->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">Aucun cours trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $cours->links() }}
</div>
@endsection
