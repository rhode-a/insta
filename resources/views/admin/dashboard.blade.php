{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="alert alert-success">
        Bonjour <strong>{{ Auth::user()->name }}</strong> !
    </div>

    @php
        $role = Auth::user()->role;
    @endphp

    @if($role === 'admin')
        <h3 class="mb-4">Tableau de bord Administrateur</h3>
        <div class="row">
            <div class="col-md-4 mb-3">
                <a href="{{ route('matieres.index') }}" class="btn btn-primary w-100">Matières</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('cours.index') }}" class="btn btn-primary w-100">Cours</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('articles.index') }}" class="btn btn-primary w-100">Articles</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('etudiants.index') }}" class="btn btn-primary w-100">Étudiants</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('formateurs.index') }}" class="btn btn-primary w-100">Formateurs</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('niveaux.index') }}" class="btn btn-primary w-100">Niveaux</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('notes.index') }}" class="btn btn-primary w-100">Notes</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('options.index') }}" class="btn btn-primary w-100">Options</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('preinscriptions.index') }}" class="btn btn-primary w-100">Préinscriptions</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary w-100">Utilisateurs</a>
            </div>
        </div>

    @elseif($role === 'formateur')
        <h3 class="mb-4">Espace Formateur</h3>
        <p>Code formateur : <strong>{{ Auth::user()->formateur->code ?? 'Non défini' }}</strong></p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('cours.index') }}" class="btn btn-success w-100">Mes Cours</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('articles.create') }}" class="btn btn-success w-100">Publier un article</a>
            </div>
        </div>

        <div class="row g-4 mt-4">
            @foreach([
                ['title' => 'Les Cours', 'text' => 'Voir les cours que vous avez dispensés.', 'route' => 'cours.index'],
                ['title' => 'Mon Profil', 'text' => 'Voir mes informations personnelles.', 'route' => 'profile.show', 'id' => auth()->user()->id],
                ['title' => 'Les Matières', 'text' => 'Voir les matières concernées.', 'route' => 'matieres.index'],
                ['title' => 'Les Étudiants', 'text' => 'Voir la liste des étudiants.', 'route' => 'etudiants.index'],
                ['title' => 'Les Formateurs', 'text' => 'Voir la liste des formateurs.', 'route' => 'formateurs.index'],
                ['title' => 'Les Articles', 'text' => 'Voir ou publier des articles.', 'route' => 'articles.index'],
                ['title' => 'Les Notes', 'text' => 'Voir les notes des étudiants.', 'route' => 'notes.index'],
                ['title' => 'Les Options', 'text' => 'Voir les différentes options.', 'route' => 'options.index'],
                ['title' => 'Les Utilisateurs', 'text' => 'Voir les différents utilisateurs.', 'route' => 'users.index'],
                ['title' => 'Les Préinscriptions', 'text' => 'Voir les différentes préinscriptions.', 'route' => 'preinscriptions.index'],
            ] as $card)
                <div class="col-md-4">
                    <div class="card text-white bg-info shadow h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $card['title'] }}</h5>
                            <p class="card-text">{{ $card['text'] }}</p>
                            <a href="{{ route($card['route'], $card['id'] ?? null) }}" class="btn btn-light btn-sm">Voir</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    @elseif($role === 'etudiant')
        <h3 class="mb-4">Espace Étudiant</h3>
        <p>Matricule : <strong>{{ Auth::user()->etudiant->matricule ?? 'Non défini' }}</strong></p>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('notes.index') }}" class="btn btn-warning w-100">Voir mes Notes</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('articles.index') }}" class="btn btn-warning w-100">Voir les Articles</a>
            </div>
        </div>

    @elseif($role === 'parent')
        <h3 class="mb-4">Bienvenue cher parent !</h3>
        <p class="text-muted">Merci de suivre la progression de vos enfants sur notre plateforme.</p>

    @else
        <p class="text-danger">Rôle non reconnu.</p>
    @endif
</div>
@endsection
