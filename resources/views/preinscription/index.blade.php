@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📋 Liste des Préinscriptions</h2>
        <a href="{{ route('preinscription.formulaire') }}" class="btn btn-outline-primary">
            ➕ Ajouter une préinscription
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Niveau</th>
                    <th>Option</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($preinscriptions as $preinscription)
                    <tr>
                        <td>{{ $preinscription->id }}</td>
                        <td>{{ $preinscription->nom }}</td>
                        <td>{{ $preinscription->prenom }}</td>
                        <td>{{ $preinscription->email }}</td>
                        <td>{{ $preinscription->telephone }}</td>
                        <td>{{ $preinscription->niveau }}</td>
                        <td>{{ $preinscription->option }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2 flex-wrap">
                                <form action="{{ route('preinscription.destroy', $preinscription->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        🗑️ Supprimer
                                    </button>
                                </form>

                                <a href="{{ route('etudiants.create1', $preinscription->id) }}" class="btn btn-sm btn-success">
                                    ✅ Valider
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted text-center">Aucune préinscription enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
