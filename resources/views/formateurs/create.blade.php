{{-- resources/views/formateurs/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ajouter un Formateur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('formateurs.store') }}" method="POST" class="needs-validation" novalidate>
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') }}" required>
            <div class="invalid-feedback">Veuillez entrer le nom.</div>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="{{ old('prenom') }}" required>
            <div class="invalid-feedback">Veuillez entrer le prénom.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Telephone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
            <div class="invalid-feedback">Veuillez entrer une adresse email valide.</div>
        </div>

        <div class="mb-3">
            <label for="code_formateur" class="form-label">Code formateur</label>
            <input type="text" class="form-control" id="matricule" name="matricule" value="{{ old('code_formateur', 'form-' . rand(1000,9999)) }}" required>
            <div class="invalid-feedback">Veuillez générer un code valide.</div>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('formateurs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<script>
    // Validation JS Bootstrap
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
