@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Détail Formateur</h2>

    <div class="card mb-3">
        <div class="card-header">
            {{ $formateur->prenom }} {{ $formateur->nom }} — {{ $formateur->code }}
        </div>
        <div class="card-body">
            <p><strong>Email :</strong> {{ $formateur->email }}</p>
            <p><strong>Téléphone :</strong> {{ $formateur->telephone ?? '-' }}</p>
            <p><strong>Options :</strong> 
                @foreach($formateur->options as $option)
                    <span class="badge bg-secondary">{{ $option->nom }}</span>
                @endforeach
            </p>
            <p><strong>Total heures :</strong> {{ $formateur->heuresTotal() }}</p>
            <p><strong>Montant mensuel :</strong> {{ number_format($formateur->montantMensuel(), 0, ',', ' ') }} FCFA</p>

            @if(auth()->user()->role === 'admin')
            <a href="{{ route('formateurs.edit', $formateur->id) }}" class="btn btn-warning">Modifier</a>

            <form action="{{ route('formateurs.destroy', $formateur->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Supprimer</button>
            </form>
            @endif
        </div>
    </div>

    <a href="{{ route('formateurs.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection
