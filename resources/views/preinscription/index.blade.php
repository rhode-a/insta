@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">📋 Liste des Préinscriptions</h2>
        <a href="{{ route('preinscription.formulaire') }}" class="btn btn-outline-primary rounded-pill px-4">
            ➕ Ajouter une préinscription
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle me-2" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm3.354-8.354-3.182 3.182-1.182-1.182a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3.536-3.536a.5.5 0 0 0-.707-.707z"/>
            </svg>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded bg-white">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light text-center text-uppercase small">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Niveau</th>
                    <th>Option</th>
                    <th style="min-width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($preinscriptions as $preinscription)
                    <tr class="align-middle">
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
                                    <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3">
                                        🗑️ Supprimer
                                    </button>
                                </form>

                                <a href="{{ route('etudiants.create1', $preinscription->id) }}" class="btn btn-sm btn-success rounded-pill px-3">
                                    ✅ Valider
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-muted fst-italic">Aucune préinscription enregistrée.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
