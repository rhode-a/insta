@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-secondary ">Tableau de bord Formateur</h2>

    <div class="row g-4">
        <!-- Cours -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary  shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Les Cours</h5>
                    <p class="card-text">Voir les cours que vous avez dispensés.</p>
                    <a href="{{ route('cours.index') }}" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <!-- Profil -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary  shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Mon Profil</h5>
                    <p class="card-text">Voir mes informations personnelles.</p>
                    <a href="{{ route('profile.show', auth()->user()->id) }}" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

        
        <!-- Formateurs -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary  shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Les Formateurs</h5>
                    <p class="card-text">Voir la liste des formateurs.</p>
                    <a href="{{ route('formateurs.index') }}" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <!-- Articles -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary  shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Les Articles</h5>
                    <p class="card-text">Voir ou publier des articles.</p>
                    <a href="{{ route('articles.index') }}" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="col-md-4">
            <div class="card text-white bg-secondary  shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Les Notes</h5>
                    <p class="card-text">Voir les notes des étudiants.</p>
                    <a href="{{ route('notes.index') }}" class="btn btn-light btn-sm">Voir</a>
                </div>
            </div>
        </div>

       
</div>
@endsection
