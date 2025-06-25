@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-10 mt-12 bg-white shadow-xl rounded-2xl border border-gray-200">

    <h2 class="text-3xl font-extrabold text-indigo-700 mb-8 border-b pb-3 flex items-center gap-2">
        <i class="bi bi-person-circle text-4xl"></i> Mon Profil
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 text-gray-800">
        <!-- Nom -->
        <div>
            <p class="text-sm text-gray-500 mb-1">Nom complet</p>
            <p class="text-xl font-semibold tracking-wide">{{ $user->name }}</p>
        </div>

        <!-- Email -->
        <div>
            <p class="text-sm text-gray-500 mb-1">Adresse e-mail</p>
            <p class="text-xl font-semibold tracking-wide">{{ $user->email }}</p>
        </div>

        <!-- Rôle -->
        <div>
            <p class="text-sm text-gray-500 mb-1">Rôle</p>
            <span class="inline-block px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm font-medium capitalize">
                <i class="bi bi-person-badge me-1"></i> {{ $user->role }}
            </span>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 mt-12">
        <!-- Modifier -->
        <a href="{{ route('profile.edit', $user->id) }}"
           class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-3 rounded-lg transition-all shadow-sm">
            <i class="bi bi-pencil-square me-2"></i> Modifier mes informations
        </a>

        <!-- Supprimer -->
        <form action="{{ route('profile.destroy', $user->id) }}" method="POST"
              onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
            @csrf
            @method('DELETE')
            <button type="submit"
                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-medium px-6 py-3 rounded-lg transition-all shadow-sm">
                <i class="bi bi-trash-fill me-2"></i> Supprimer mon compte
            </button>
        </form>
    </div>
</div>
@endsection
