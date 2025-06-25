@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ajouter un Cours</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cours.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        {{-- Matière --}}
        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select name="matiere_id" id="matiere_id" class="form-select" required>
                <option value="">-- Sélectionnez une matière --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir une matière.</div>
        </div>

        {{-- Formateur --}}
        <div class="mb-3">
            <label for="formateur_id" class="form-label">Formateur</label>
            <select name="formateur_id" id="formateur_id" class="form-select" required>
                <option value="">-- Sélectionnez un formateur --</option>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}" {{ old('formateur_id') == $formateur->id ? 'selected' : '' }}>
                        {{ $formateur->nom }} {{ $formateur->prenom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir un formateur.</div>
        </div>

        {{-- Option --}}
        <div class="mb-3">
            <label for="option_id" class="form-label">Option</label>
            <select name="option_id" id="option_id" class="form-select" required>
                <option value="">-- Sélectionnez une option --</option>
                @foreach($options as $option)
                    <option value="{{ $option->id }}" {{ old('option_id') == $option->id ? 'selected' : '' }}>
                        {{ $option->nom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir une option.</div>
        </div>

        {{-- Intitulé --}}
        <div class="mb-3">
            <label for="intitule" class="form-label">Intitulé</label>
            <input type="text" name="intitule" id="intitule" class="form-control" value="{{ old('intitule') }}" required>
            <div class="invalid-feedback">Veuillez entrer un intitulé.</div>
        </div>

        {{-- Nombre d'heures --}}
        <div class="mb-3">
            <label for="nombre_heures" class="form-label">Durée (en heures)</label>
            <input type="number" name="nombre_heures" id="nombre_heures" class="form-control" min="1" value="{{ old('nombre_heures') }}" required>
            <div class="invalid-feedback">Veuillez entrer une durée.</div>
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date du cours</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}" required>
            <div class="invalid-feedback">Veuillez entrer une date valide.</div>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('cours.index') }}" class="btn btn-secondary">Annuler</a>
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
