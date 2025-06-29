<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil - T.T.G Network</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4">

    <div class="bg-white max-w-2xl w-full rounded-xl shadow-lg border border-gray-200 p-8">
        <!-- Header -->
        <div class="flex items-center gap-4 mb-6 border-b pb-4">
            <div class="bg-indigo-100 text-indigo-600 rounded-full p-3 text-3xl">
                <i class="bi bi-person-circle"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Mon Profil</h1>
        </div>

        <!-- Infos utilisateur -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700 mb-8">
            <div>
                <p class="text-sm text-gray-500">Nom complet</p>
                <p class="text-lg font-semibold">{{  Auth::user()->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Adresse e-mail</p>
                <p class="text-lg font-semibold">{{  Auth::user()->email }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Rôle</p>
                <span class="inline-flex items-center gap-2 bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm capitalize">
                    <i class="bi bi-person-badge"></i> {{  Auth::user()->role }}
                </span>
            </div>
        </div>

        <!-- Boutons -->
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('profile.edit',  Auth::user()->id) }}"
               class="flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition">
                <i class="bi bi-pencil-square"></i> Modifier
            </a>

            <form action="{{ route('profile.destroy',  Auth::user()->id) }}" method="POST"
                  onsubmit="return confirm('Voulez-vous vraiment supprimer votre compte ?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="flex items-center justify-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow transition">
                    <i class="bi bi-trash-fill"></i> Supprimer
                </button>
            </form>
        </div>
    </div>

</body>
</html>
