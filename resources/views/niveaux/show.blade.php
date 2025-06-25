@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Détails du Niveau</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom : {{ $niveau->nom }}</h5>
            <p class="card-text">ID : {{ $niveau->id }}</p>

            <a href="{{ route('niveaux.edit', $niveau) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('niveaux.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
