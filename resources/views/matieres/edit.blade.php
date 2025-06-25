@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Modifier la Matière</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('matieres.update', $matiere->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom', $matiere->nom) }}" required>
        </div>

        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" class="form-control" value="{{ old('coefficient', $matiere->coefficient) }}" required>
        </div>

        <div class="mb-3">
            <label for="formateurs" class="form-label">Formateurs</label>
            <select name="formateurs[]" class="form-select" multiple>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}" {{ $matiere->formateurs->contains($formateur->id) ? 'selected' : '' }}>
                        {{ $formateur->nom }} {{ $formateur->prenom }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('matieres.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
