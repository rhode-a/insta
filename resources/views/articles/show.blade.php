@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="text-3xl font-bold mb-4">{{ $article->titre }}</h2>
    <p class="text-gray-600 mb-3">Publié par <strong>{{ $article->user->name }}</strong></p>
    <p class="text-sm text-gray-500 mb-4"> 
        le {{ $article->created_at->format('d/m/Y à H:i') }}
    </p>
    <div class="bg-white p-4 rounded shadow">
        {!! nl2br(e($article->contenu)) !!}
    </div>
    <a href="{{ route('articles.index') }}" class="mt-4 inline-block text-indigo-600 hover:underline">← Retour à la liste</a>
</div>

  {{-- Boutons Modifier / Supprimer (visible si admin ou auteur) --}}
    @if(auth()->user()->role === 'admin' || auth()->id() === $article->user_id)
        <div class="flex flex-wrap gap-4 mb-6">
            <a href="{{ route('articles.edit', $article->id) }}" 
            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium px-4 py-2 rounded">
                ✏️ Modifier
            </a>

            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded">
                    🗑️ Supprimer
                </button>
            </form>
        </div>
    @endif

                <a href="{{ route('articles.index') }}" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded">
                    ← Retour aux articles
                </a>
            </div>
        </div>
 @endsection


