@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Ajouter une Matière</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('matieres.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{ old('nom') }}" required>
        </div>

        <div class="mb-3">
            <label for="coefficient" class="form-label">Coefficient</label>
            <input type="number" name="coefficient" class="form-control" value="{{ old('coefficient') }}" required>
        </div>

        <div class="mb-3">
            <label for="formateurs" class="form-label">Formateurs</label>
            <select name="formateurs[]" class="form-select" multiple>
                @foreach($formateurs as $formateur)
                    <option value="{{ $formateur->id }}">{{ $formateur->nom }} {{ $formateur->prenom }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
        <a href="{{ route('matieres.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
