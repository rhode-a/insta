@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mx-auto bg-white shadow-sm rounded-4 p-5" style="max-width: 720px;">
        <h2 class="fw-bold text-success mb-4">➕ Ajouter une Matière</h2>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('matieres.store') }}" method="POST" class="mt-4">
            @csrf

            <div class="mb-4">
                <label for="nom" class="form-label fw-semibold">Nom</label>
                <input type="text" name="nom" class="form-control rounded-pill shadow-sm px-4 py-2"
                    value="{{ old('nom') }}" placeholder="Nom de la matière" required>
            </div>

            <div class="mb-4">
                <label for="coefficient" class="form-label fw-semibold">Coefficient</label>
                <input type="number" name="coefficient" class="form-control rounded-pill shadow-sm px-4 py-2"
                    value="{{ old('coefficient') }}" placeholder="Coefficient (ex : 3)" required>
            </div>

            <div class="mb-4">
                <label for="formateurs" class="form-label fw-semibold">Formateurs</label>
                <select name="formateurs[]" class="form-select shadow-sm rounded-3" multiple>
                    @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}">{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Maintenez Ctrl ou Cmd pour sélectionner plusieurs.</small>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-success rounded-pill px-4">
                    ✅ Créer
                </button>
                <a href="{{ route('matieres.index') }}" class="btn btn-outline-secondary rounded-pill">
                    ← Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
