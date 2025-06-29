@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">Liste des Utilisateurs</h2>

    <a href="{{ route('users.create') }}" class="btn btn-success mb-4 rounded px-4 shadow-sm">
        + Ajouter un utilisateur
    </a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <strong class="me-auto">✔️</strong> {{ session('success') }}
            <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Fermer"></button>
        </div>
    @endif

    @if($users->count())
        <table class="table table-hover align-middle" style="border-collapse: separate; border-spacing: 0 0.75rem;">
            <thead class="bg-primary text-white rounded-3">
                <tr>
                    <th class="rounded-start text-start ps-4">Nom</th>
                    <th class="text-start">Email</th>
                    <th class="text-start">Rôle</th>
                    <th class="rounded-end text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="shadow-sm bg-white rounded">
                        <td class="fw-semibold text-start ps-4">{{ $user->name }}</td>
                        <td class="text-start">{{ $user->email }}</td>
                        <td class="text-capitalize text-start">{{ $user->role }}</td>
                        <td class="text-center">
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-primary me-2">
                                Modifier
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3 d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    @else
        <p class="text-center text-muted fst-italic">Aucun utilisateur trouvé.</p>
    @endif
</div>
@endsection
