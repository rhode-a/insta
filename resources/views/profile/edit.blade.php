<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modifier mon profil - T.T.G Network</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-indigo-100 via-purple-50 to-pink-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-lg w-full bg-white/90 backdrop-blur-md rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 text-center">Modifier mon profil</h1>

        @if(session('status') === 'profile-updated')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 text-center">
                Profil mis à jour avec succès !
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update',  Auth::user()->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block font-semibold mb-2 text-gray-700">Nom complet</label>
                <input type="text" name="name" id="name" value="{{ old('name',  Auth::user()->name) }}" 
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror" required>
                @error('name')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block font-semibold mb-2 text-gray-700">Adresse email</label>
                <input type="email" name="email" id="email" value="{{ old('email',  Auth::user()->email) }}" 
                       class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror" required>
                @error('email')
                    <p class="text-red-600 mt-1 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" 
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition">
                Enregistrer les modifications
            </button>
        </form>
    </div>

</body>
</html>
