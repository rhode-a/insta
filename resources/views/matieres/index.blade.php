@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Liste des Matières</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('matieres.create') }}" class="btn btn-primary mb-3">Ajouter une matière</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Coefficient</th>
                <th>Formateurs</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matieres as $matiere)
                <tr>
                    <td>{{ $matiere->nom }}</td>
                    <td>{{ $matiere->coefficient }}</td>
                    <td>
                        @foreach($matiere->formateurs as $formateur)
                            {{ $formateur->nom }} {{ $formateur->prenom }}<br>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('matieres.edit', $matiere->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('matieres.destroy', $matiere->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $matieres->links() }}
</div>
@endsection
