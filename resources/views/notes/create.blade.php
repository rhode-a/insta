{{-- resources/views/notes/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ajouter une Note</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('notes.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="etudiant_id" class="form-label">Étudiant</label>
            <select id="etudiant_id" name="etudiant_id" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez un étudiant --</option>
                @foreach($etudiants as $etudiant)
                    <option value="{{ $etudiant->id }}" {{ old('etudiant_id') == $etudiant->id ? 'selected' : '' }}>
                        {{ $etudiant->nom }}  {{ $etudiant->prenom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir un étudiant.</div>
        </div>

        <div class="mb-3">
            <label for="matiere_id" class="form-label">Matière</label>
            <select id="matiere_id" name="matiere_id" class="form-select" required>
                <option value="" disabled selected>-- Sélectionnez une matière --</option>
                @foreach($matieres as $matiere)
                    <option value="{{ $matiere->id }}" {{ old('matiere_id') == $matiere->id ? 'selected' : '' }}>
                        {{ $matiere->nom }} ({{ $matiere->option_id }})
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Veuillez choisir une matière.</div>
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <input type="number" step="0.01" min="0" max="20" id="valeur" name="valeur" class="form-control" value="{{ old('note') }}" required>
            <div class="invalid-feedback">Veuillez entrer une note entre 0 et 20.</div>
        </div>

        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" step="0.01" min="0" id="coefficient" name="coefficient" class="form-control" value="{{ old('coefficient') ?? 1 }}" required>
            <div class="invalid-feedback">Veuillez entrer un coefficient valide.</div>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>

<script>
    // Bootstrap form validation JS
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
</script>
@endsection
