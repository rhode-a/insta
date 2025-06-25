@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Ajouter un Niveau</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('niveaux.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Niveau</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
