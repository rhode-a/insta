@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Ajouter un Utilisateur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirmer mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Rôle</label>
            <select name="role" class="form-select" required>
                <option value="">-- Sélectionner un rôle --</option>
                <option value="admin">Admin</option>
                <option value="etudiant">Étudiant</option>
                <option value="formateur">Formateur</option>
                <option value="parent">Parent</option>
            </select>
        </div>

        <button class="btn btn-primary">Créer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
