@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mx-auto bg-white shadow-sm rounded-4 p-5" style="max-width: 720px;">
        <h2 class="fw-bold text-primary mb-4">✏️ Modifier la Matière</h2>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm rounded-3">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('matieres.update', $matiere->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="nom" class="form-label fw-semibold">Nom</label>
                <input type="text" name="nom" id="nom"
                    class="form-control rounded-pill shadow-sm px-4 py-2"
                    value="{{ old('nom', $matiere->nom) }}" required
                    placeholder="Nom de la matière">
            </div>

            <div class="mb-4">
                <label for="coefficient" class="form-label fw-semibold">Coefficient</label>
                <input type="number" name="coefficient" id="coefficient"
                    class="form-control rounded-pill shadow-sm px-4 py-2"
                    value="{{ old('coefficient', $matiere->coefficient) }}" required
                    placeholder="Coefficient (ex : 3)">
            </div>

            <div class="mb-4">
                <label for="formateurs" class="form-label fw-semibold">Formateurs</label>
                <select name="formateurs[]" id="formateurs"
                        class="form-select shadow-sm rounded-3" multiple>
                    @foreach($formateurs as $formateur)
                        <option value="{{ $formateur->id }}" 
                            {{ $matiere->formateurs->contains($formateur->id) ? 'selected' : '' }}>
                            {{ $formateur->nom }} {{ $formateur->prenom }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">Maintenez Ctrl ou Cmd pour sélectionner plusieurs.</small>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    💾 Mettre à jour
                </button>
                <a href="{{ route('matieres.index') }}" class="btn btn-outline-secondary rounded-pill">
                    ← Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
