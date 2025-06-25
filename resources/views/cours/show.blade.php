@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Détails du Cours</h2>

    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title">{{ $cours->intitule }}</h4>
            <p><strong>Matière :</strong> {{ $cours->matiere->nom ?? '-' }}</p>
            <p><strong>Formateur :</strong> {{ $cours->formateur->nom ?? '-' }} {{ $cours->formateur->prenom ?? '' }}</p>
            <p><strong>Option :</strong> {{ $cours->option->nom ?? '-' }}</p>
            <p><strong>Durée :</strong> {{ $cours->nombre_heures }} heure(s)</p>
            <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($cours->date)->format('d/m/Y') }}</p>

            <a href="{{ route('cours.edit', $cours->id) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('cours.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>
@endsection
