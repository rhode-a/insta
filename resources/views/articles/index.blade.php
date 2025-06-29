@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📰 Articles publiés</h2>
        <a href="{{ route('articles.create') }}" class="btn btn-outline-primary rounded-pill shadow-sm px-4">
            ➕ Nouvel Article
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($articles->count())
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 rounded-4">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title fw-bold text-dark">{{ $article->titre }}</h5>
                        <p class="card-text text-muted text-truncate" style="max-height: 3.6em; line-height: 1.2em;">
                            {{ Str::limit(strip_tags($article->contenu), 150) }}
                        </p>
                    </div>
                    <div class="mt-3 small text-muted">
                        <p class="mb-1">✍️ Par <strong>{{ $article->auteur->name ?? 'Inconnu' }}</strong></p>
                        <p class="mb-2">🕒 {{ $article->created_at->diffForHumans() }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                                📖 Lire
                            </a>

                            @can('delete', $article)
                            <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger rounded-pill">🗑️</button>
                            </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $articles->links() }}
    </div>

    @else
        <div class="alert alert-info rounded shadow-sm">
            Aucun article publié pour le moment.
        </div>
    @endif

</div>
@endsection
