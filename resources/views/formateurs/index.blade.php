{{-- Liste des formateurs --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Liste des Formateurs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('formateurs.create') }}" class="btn btn-primary mb-3">Ajouter un Formateur</a>
    @endif

    @if($formateurs->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Code</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($formateurs as $formateur)
                <tr>
                    <td>{{ $formateur->nom }}</td>
                    <td>{{ $formateur->prenom }}</td>
                    <td>{{ $formateur->matricule }}</td>
                    <td>{{ $formateur->email }}</td>
                    <td>
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('formateurs.edit', $formateur) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('formateurs.destroy', $formateur) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce formateur ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Supprimer</button>
                            </form>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $formateurs->links() }}
    @else
        <p>Aucun formateur trouvé.</p>
    @endif
</div>
@endsection
