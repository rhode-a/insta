@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Modifier le Niveau</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('niveaux.update', $niveau) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nom" class="form-label">Nom du Niveau</label>
            <input type="text" name="nom" id="nom" value="{{ $niveau->nom }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
