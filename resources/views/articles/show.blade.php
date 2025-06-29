@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="mb-4">
        <h2 class="fw-bold display-6 text-primary">{{ $article->titre }}</h2>
        <p class="text-muted mb-1">Publié par <strong class="text-dark">{{ $article->user->name }}</strong></p>
        <p class="text-secondary small">🕒 {{ $article->created_at->format('d/m/Y à H:i') }}</p>
    </div>

    <div class="bg-white shadow-sm rounded-4 p-4 mb-4" style="line-height: 1.8;">
        {!! nl2br(e($article->contenu)) !!}
    </div>

    <div class="d-flex flex-wrap gap-3 mb-4">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-primary rounded-pill">
            ← Retour à la liste
        </a>

        {{-- Boutons Modifier / Supprimer (admin ou auteur) --}}
        @if(auth()->user()->role === 'admin' || auth()->id() === $article->user_id)
            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-outline-warning rounded-pill">
                ✏️ Modifier
            </a>

            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger rounded-pill">
                    🗑️ Supprimer
                </button>
            </form>
        @endif
    </div>

    <a href="{{ route('articles.index') }}" class="btn btn-primary rounded-pill px-4">
        ← Retour aux articles
    </a>

</div>
@endsection
