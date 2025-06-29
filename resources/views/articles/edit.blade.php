@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="mx-auto bg-white shadow-sm rounded-4 p-5" style="max-width: 720px;">
        <h1 class="text-primary fw-bold mb-4 fs-3">✏️ Modifier l'article</h1>

        @if ($errors->any())
            <div class="alert alert-danger rounded-3 shadow-sm">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST" class="mt-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titre" class="form-label fw-semibold">Titre</label>
                <input type="text" id="titre" name="titre"
                    value="{{ old('titre', $article->titre) }}"
                    class="form-control shadow-sm rounded-pill px-4 py-2"
                    placeholder="Titre de l'article">
            </div>

            <div class="mb-5">
                <label for="contenu" class="form-label fw-semibold">Contenu</label>
                <textarea id="contenu" name="contenu" rows="8"
                    class="form-control shadow-sm rounded-3 p-3"
                    placeholder="Contenu de l'article">{{ old('contenu', $article->contenu) }}</textarea>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    💾 Enregistrer
                </button>
                <a href="{{ route('articles.show', $article->id) }}" class="text-muted small text-decoration-underline">
                    ← Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
