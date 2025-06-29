@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-info">Tableau de bord Parent</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Notes des Enfants</h5>
                    <p class="card-text">Suivre les résultats scolaires.</p>
                    <a href="{{ route('notes.index') }}" class="btn btn-light btn-sm">Voir les notes</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Articles & Annonces</h5>
                    <p class="card-text">Lire les nouvelles de l'école.</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-light btn-sm">Accéder</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
