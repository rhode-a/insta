@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mx-auto bg-white shadow-sm rounded-4 p-5" style="max-width: 720px;">
        <h2 class="fw-bold text-success mb-4">➕ Ajouter un Cours</h2>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cours.store') }}" method="POST" class="needs-validation mt-4" novalidate>
            @csrf

            <div class="mb-4">
                <label for="matiere_id" class="form-label fw-semibold">Matière</label>
                <select name="matiere_id" id="matiere_id" class="form-select rounded-3 shadow-sm" required>
                    <option value="">-- Sélectionnez une matière --</option>
                    @foreach($matieres as $matiere)
                        <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                            {{ $matiere->nom }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Veuillez choisir une matière.</div>
            </div>

            <div class="mb-4">
                <label for="formateur_id" class="form-label fw-semibold">Formateur</label>
                <select name="formateur_id" id="formateur_id" class="form-select rounded-3 shadow-sm" required>
                    <option value="">-- Sélectionnez un formateur --</option>
                    @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}" {{ old('formateur_id') == $formateur->id ? 'selected' : '' }}>
                            {{ $formateur->nom }} {{ $formateur->prenom }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Veuillez choisir un formateur.</div>
            </div>

            <div class="mb-4">
                <label for="option_id" class="form-label fw-semibold">Option</label>
                <select name="option_id" id="option_id" class="form-select rounded-3 shadow-sm" required>
                    <option value="">-- Sélectionnez une option --</option>
                    @foreach($options as $option)
                        <option value="{{ $option->id }}" {{ old('option_id') == $option->id ? 'selected' : '' }}>
                            {{ $option->nom }}
                        </option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Veuillez choisir une option.</div>
            </div>

            <div class="mb-4">
                <label for="intitule" class="form-label fw-semibold">Intitulé</label>
                <input type="text" name="intitule" id="intitule" class="form-control rounded-pill shadow-sm px-4 py-2"
                       value="{{ old('intitule') }}" required placeholder="Intitulé du cours">
                <div class="invalid-feedback">Veuillez entrer un intitulé.</div>
            </div>

            <div class="mb-4">
                <label for="nombre_heures" class="form-label fw-semibold">Durée (en heures)</label>
                <input type="number" name="nombre_heures" id="nombre_heures" min="1" class="form-control rounded-pill shadow-sm px-4 py-2"
                       value="{{ old('nombre_heures') }}" required placeholder="Nombre d'heures">
                <div class="invalid-feedback">Veuillez entrer une durée valide.</div>
            </div>

            <div class="mb-4">
                <label for="date" class="form-label fw-semibold">Date du cours</label>
                <input type="date" name="date" id="date" class="form-control rounded-pill shadow-sm px-4 py-2"
                       value="{{ old('date') }}" required>
                <div class="invalid-feedback">Veuillez entrer une date valide.</div>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    💾 Enregistrer
                </button>
                <a href="{{ route('cours.index') }}" class="btn btn-outline-secondary rounded-pill">
                    ← Annuler
                </a>
            </div>
        </form>
    </div>
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
