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
                <a href="{{ route('matieres.index') }}" class="btn btn-primary w-100">Gérer les Matières</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('cours.index') }}" class="btn btn-primary w-100">Voir les Cours</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="{{ route('articles.index') }}" class="btn btn-primary w-100">Articles</a>
            </div>
        </div>
    @elseif($role === 'formateur')
        <h3 class="mb-4">Espace Formateur</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('cours.index') }}" class="btn btn-secondary  w-100">Mes Cours</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('articles.create') }}" class="btn btn-secondary  w-100">Publier un article</a>
            </div>
        </div>
    @elseif($role === 'etudiant')
        <h3 class="mb-4">Espace Étudiant</h3>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="{{ route('notes.index') }}" class="btn btn-success w-100">Voir mes Notes</a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="{{ route('articles.index') }}" class="btn btn-success w-100">Voir les Articles</a>
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
