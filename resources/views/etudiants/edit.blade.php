@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Modifier l'étudiant {{ $etudiant->prenom }} {{ $etudiant->nom }}</h2>

    <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Même champs que create.blade.php, mais avec valeurs remplies -->

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror" id="prenom" value="{{ old('prenom', $etudiant->prenom) }}" required>
            @error('prenom')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" id="nom" value="{{ old('nom', $etudiant->nom) }}" required>
            @error('nom')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email', $etudiant->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone (optionnel)</label>
            <input type="text" name="telephone" class="form-control @error('telephone') is-invalid @enderror" id="telephone" value="{{ old('telephone', $etudiant->telephone) }}">
            @error('telephone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="option_id" class="form-label">Option</label>
            <select name="option_id" id="option_id" class="form-select @error('option_id') is-invalid @enderror" required>
                <option value="">-- Choisir une option --</option>
                @foreach($options as $option)
                <option value="{{ $option->id }}" {{ (old('option_id', $etudiant->option_id) == $option->id) ? 'selected' : '' }}>{{ $option->nom }}</option>
                @endforeach
            </select>
            @error('option_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="niveau_id" class="form-label">Niveau</label>
            <select name="niveau_id" id="niveau_id" class="form-select @error('niveau_id') is-invalid @enderror" required>
                <option value="">-- Choisir un niveau --</option>
                @foreach($niveaux as $niveau)
                <option value="{{ $niveau->id }}" {{ (old('niveau_id', $etudiant->niveau_id) == $niveau->id) ? 'selected' : '' }}>{{ $niveau->nom }}</option>
                @endforeach
            </select>
            @error('niveau_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
