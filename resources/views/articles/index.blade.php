@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Articles publiés</h2>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">Nouvel Article</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($articles->count())
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->titre }}</h5>
                            <p class="card-text text-truncate">{{ $article->contenu }}</p>
                            <p class="text-muted mb-1">Publié par : <strong>{{ $article->auteur->name ?? 'Inconnu' }}</strong></p>
                            <p class="text-muted small">{{ $article->created_at->diffForHumans() }}</p>
                            <a href="{{ route('articles.show', $article) }}" class="btn btn-sm btn-outline-primary">Lire</a>

                            @can('delete', $article)
                                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cet article ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Supprimer</button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $articles->links() }}
    @else
        <p>Aucun article publié pour le moment.</p>
    @endif
</div>
@endsection
