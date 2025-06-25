@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Créer un étudiant</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('etudiants.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $data['nom'] ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ old('prenom', $data['prenom'] ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $data['email'] ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone', $data['telephone'] ?? '') }}" required>
        </div>

       <div class="mb-3">
            <label for="option_id" class="form-label">Option</label>
            <select name="option_id" id="option_id" class="form-select @error('option_id') is-invalid @enderror" required>
                <option value="">-- Choisir une option --</option>
                @foreach($options as $option)
                <option value="{{ $option->id }}" {{ old('option_id') == $option->id ? 'selected' : '' }}>{{ $option->nom }}</option>
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
                <option value="{{ $niveau->id }}" {{ old('niveau_id') == $niveau->id ? 'selected' : '' }}>{{ $niveau->nom }}</option>
                @endforeach
            </select>
            @error('niveau_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Champs supplémentaires si nécessaires --}}
        <div class="mb-3">
            <label for="matricule" class="form-label">Matricule (si généré manuellement)</label>
            <input type="text" name="matricule" id="matricule" class="form-control" value="{{ old('matricule') }}">
        </div>

        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" class="form-control" value="{{ old('date_naissance') }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer l'étudiant</button>
        <a href="{{ route('preinscriptions.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
@endsection
