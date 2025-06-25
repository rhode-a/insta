@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Liste des Formateurs</h2>
    <a href="{{ route('formateurs.create') }}" class="btn btn-primary mb-3">Ajouter un Formateur</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Code</th>
                <th>Nom complet</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Options</th>
                <th>Total heures</th>
                <th>Montant mensuel (FCFA)</th>
                @if(auth()->user()->role === 'admin')
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse($formateurs as $formateur)
            <tr>
                <td>{{ $formateur->code }}</td>
                <td>{{ $formateur->prenom }} {{ $formateur->nom }}</td>
                <td>{{ $formateur->email }}</td>
                <td>{{ $formateur->telephone ?? '-' }}</td>
                <td>
                    @foreach($formateur->options as $option)
                        <span class="badge bg-secondary">{{ $option->nom }}</span>
                    @endforeach
                </td>
                <td>{{ $formateur->heuresTotal() }}</td>
                <td>{{ number_format($formateur->montantMensuel(), 0, ',', ' ') }}</td>
                @if(auth()->user()->role === 'admin')
                <td>
                    <a href="{{ route('formateurs.edit', $formateur->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                    <form action="{{ route('formateurs.destroy', $formateur->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
                @endif
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">Aucun formateur trouvé.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $formateurs->links() }}
</div>
@endsection
