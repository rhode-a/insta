<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenue - T.T.G Network</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        /* Animation douce à l'apparition */
        [data-fade] {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease-out;
        }

        [data-fade].show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gradient-to-r from-indigo-700 via-purple-700 to-pink-600 min-h-screen flex flex-col font-sans">

    <!-- Header -->
    <header class="flex justify-between items-center px-6 py-5 max-w-7xl mx-auto w-full text-white">
        <h1 class="text-3xl font-extrabold tracking-wider">T.T.G Network</h1>
        <nav class="space-x-6 text-lg font-medium">
            <a href="{{ route('register') }}" class="hover:text-yellow-300 transition">Créer un compte</a>
            <a href="{{ route('login') }}" class="hover:text-yellow-300 transition">Se connecter</a>
            <a href="{{ route('preinscription.formulaire') }}" class="hover:text-yellow-300 transition">Préinscription</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col justify-center items-center px-6 text-white text-center max-w-3xl mx-auto">
        <h2 data-fade class="text-5xl font-extrabold mb-6 drop-shadow-xl">
            Bienvenue sur <span class="text-yellow-300">T.T.G Network</span>
        </h2>
        <p data-fade class="text-lg md:text-xl mb-10 max-w-xl leading-relaxed text-gray-200 drop-shadow">
            La plateforme scolaire intelligente qui facilite la gestion des étudiants, cours, notes, enseignants et plus encore.
        </p>

        <div class="space-x-4" data-fade>
            <a href="{{ route('register') }}" 
               class="bg-yellow-400 text-indigo-900 font-bold px-8 py-3 rounded-xl shadow-lg hover:bg-yellow-300 transition-all duration-300">
                Créer un compte
            </a>
            <a href="{{ route('login') }}" 
               class="bg-white text-indigo-700 font-semibold px-8 py-3 rounded-xl shadow-lg hover:bg-gray-100 transition-all duration-300">
                Se connecter
            </a>
            <a href="{{ route('preinscription.formulaire') }}" 
               class="block mt-4 text-white underline hover:text-yellow-200 font-medium transition">
                Remplir le formulaire de préinscription
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="text-gray-300 text-center py-6 bg-indigo-900 text-sm tracking-wide">
        © {{ date('Y') }} <strong>T.T.G Network</strong>. Tous droits réservés.
    </footer>

    <!-- JS animation -->
    <script>
        // Apparition animée
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('[data-fade]').forEach(el => {
                setTimeout(() => el.classList.add('show'), 200);
            });
        });
    </script>
</body>
</html>
