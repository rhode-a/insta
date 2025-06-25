{{-- resources/views/profile/index.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4">Mon Profil</h2>

        <div class="space-y-4 text-gray-800">
            <div>
                <strong>Nom :</strong> {{ Auth::user()->name }}
            </div>
            <div>
                <strong>Email :</strong> {{ Auth::user()->email }}
            </div>
            <div>
                <strong>Rôle :</strong> {{ ucfirst(Auth::user()->role) }}
            </div>
            <div>
                <strong>Inscrit le :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}
            </div>
        </div>

        <div class="mt-6 flex gap-4">
            <a href="{{ route('profile.edit') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">
                Modifier le profil
            </a>

            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Supprimer votre compte ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Supprimer le compte
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
