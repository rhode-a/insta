@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Modifier mon profil</h1>

    @if(session('status') === 'profile-updated')
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            Profil mis à jour avec succès !
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nom complet</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                   class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Adresse email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                   class="w-full border rounded px-3 py-2 @error('email') border-red-500 @enderror" required>
            @error('email')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tu peux ajouter d'autres champs ici, exemple téléphone, etc. -->

        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
            Enregistrer les modifications
        </button>
    </form>
</div>
@endsection
