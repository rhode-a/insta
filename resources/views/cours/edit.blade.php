@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Modifier un Cours</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cours.update', $cour->id) }}" method="POST" class="needs-validation" novalidate>
        @csrf
        @method('PUT')

        {{-- Matière --}}
        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select name="matiere_id" id="matiere_id" class="form-select" required>
                <option value="">-- Sélectionnez une matière --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ $cour->matiere_id == $matiere->id ? 'selected' : '' }}>
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
                    <option value="{{ $formateur->id }}" {{ $cour->formateur_id == $formateur->id ? 'selected' : '' }}>
                        {{ $formateur->nom }} {{ $formateur->prenom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir un formateur.</div>
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label for="date" class="form-label">Date du cours</label>
            <input type="date" class="form-control" name="date" id="date" value="{{ old('date', $cour->date) }}" required>
            <div class="invalid-feedback">Veuillez entrer une date.</div>
        </div>

        {{-- Durée --}}
        <div class="mb-3">
            <label for="nombre_heures" class="form-label">Durée (en heures)</label>
            <input type="number" name="nombre_heures" id="nombre_heures" class="form-control" min="1" value="{{ old('nombre_heures', $cour->nombre_heures) }}" required>
            <div class="invalid-feedback">Veuillez entrer une durée.</div>
        </div>

        {{-- Intitulé --}}
        <div class="mb-3">
            <label for="intitule" class="form-label">Intitulé</label>
            <input type="text" name="intitule" id="intitule" class="form-control" value="{{ old('intitule', $cour->intitule) }}" required>
            <div class="invalid-feedback">Veuillez entrer un intitulé.</div>
        </div>

        {{-- Option (si c’est une relation) --}}
        <div class="mb-3">
            <label for="option_id" class="form-label">Option</label>
            <select name="option_id" id="option_id" class="form-select" required>
                <option value="">-- Sélectionnez une option --</option>
                @foreach($options as $option)
                    <option value="{{ $option->id }}" {{ $cour->option_id == $option->id ? 'selected' : '' }}>
                        {{ $option->nom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir une option.</div>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
