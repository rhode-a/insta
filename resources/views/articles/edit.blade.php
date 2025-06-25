@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Modifier l'article</h1>

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('articles.update', $article->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="titre" class="block font-semibold mb-1">Titre</label>
                <input type="text" id="titre" name="titre" value="{{ old('titre', $article->titre) }}"
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-6">
                <label for="contenu" class="block font-semibold mb-1">Contenu</label>
                <textarea id="contenu" name="contenu" rows="8"
                          class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring focus:ring-indigo-200">{{ old('contenu', $article->contenu) }}</textarea>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2 rounded">
                    Enregistrer les modifications
                </button>
                <a href="{{ route('articles.show', $article->id) }}" class="text-gray-600 hover:underline">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
