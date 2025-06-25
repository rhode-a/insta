@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Détails de l'Option</h2>

    <div class="mb-3">
        <strong>Nom :</strong> {{ $option->nom }}
    </div>

    <div class="mb-3">
        <strong>Description :</strong> {{ $option->description ?? 'Aucune description.' }}
    </div>

    <a href="{{ route('options.edit', $option->id) }}" class="btn btn-warning">Modifier</a>
    <a href="{{ route('options.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
