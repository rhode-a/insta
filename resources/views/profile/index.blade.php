<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mon Profil - T.T.G Network</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-tr from-indigo-100 via-purple-50 to-pink-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-lg w-full bg-white/90 backdrop-blur-md rounded-xl shadow-lg p-8">
        <h1 class="text-3xl font-extrabold text-indigo-700 mb-8 text-center">Mon Profil</h1>

        <div class="space-y-6 text-gray-700 text-lg">
            <div><span class="font-semibold">Nom :</span> {{ Auth::user()->name }}</div>
            <div><span class="font-semibold">Email :</span> {{ Auth::user()->email }}</div>
            <div><span class="font-semibold">Rôle :</span> {{ ucfirst(Auth::user()->role) }}</div>
            <div><span class="font-semibold">Inscrit le :</span> {{ Auth::user()->created_at->format('d/m/Y') }}</div>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('profile.edit') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-semibold text-center transition">
                Modifier le profil
            </a>

            <form method="POST" action="{{ route('profile.destroy') }}" 
                  onsubmit="return confirm('Supprimer votre compte ? Cette action est irréversible.')"
                  class="w-full sm:w-auto">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full sm:w-auto bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                    Supprimer le compte
                </button>
            </form>
        </div>
    </div>

</body>
</html>
