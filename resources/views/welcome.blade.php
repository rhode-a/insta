<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bienvenue - T.T.G Network</title>

    <!-- Style de secours si pas d'accès Internet -->
    <style>
        body {
            margin: 0;
            font-family: system-ui, sans-serif;
            background: linear-gradient(to right, #4338ca, #7e22ce, #db2777);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: white;
        }

        header, footer {
            max-width: 1200px;
            width: 100%;
            margin: auto;
            padding: 20px;
        }

        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: white;
            font-weight: 600;
        }

        nav a:hover {
            color: #facc15;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 20px;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            text-shadow: 2px 2px #00000055;
        }

        p {
            font-size: 1.125rem;
            max-width: 600px;
            color: #e5e5e5;
            margin-bottom: 30px;
            text-shadow: 1px 1px #00000033;
        }

        .btn {
            padding: 12px 30px;
            margin: 0 10px;
            font-weight: bold;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-yellow {
            background-color: #facc15;
            color: #1e3a8a;
        }

        .btn-yellow:hover {
            background-color: #fde047;
        }

        .btn-white {
            background-color: white;
            color: #3730a3;
        }

        .btn-white:hover {
            background-color: #f4f4f4;
        }

        .link {
            display: block;
            margin-top: 20px;
            color: #fff;
            text-decoration: underline;
        }

        .link:hover {
            color: #fde047;
        }

        footer {
            background-color: #312e81;
            text-align: center;
            font-size: 0.875rem;
        }

        /* Animation */
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
<body>

    <!-- Header -->
    <header>
        <h1 style="font-size: 2rem; font-weight: bold;">T.T.G Network</h1>
        <nav style="margin-top: 10px;">
            <a href="{{ route('register') }}">Créer un compte</a>
            <a href="{{ route('login') }}">Se connecter</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <h2 data-fade>Bienvenue sur <span style="color: #fde047;">T.T.G Network</span></h2>
        <p data-fade>La plateforme scolaire intelligente qui facilite la gestion des étudiants, cours, notes, enseignants et plus encore.</p>

        <div data-fade>
            <a href="{{ route('register') }}" class="btn btn-white" style="text-decoration:none;">Créer un compte</a>
            <a href="{{ route('login') }}" class="btn btn-white" style="text-decoration:none;">Se connecter</a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        © {{ date('Y') }} <strong>T.T.G Network</strong>. Tous droits réservés.
    </footer>

    <!-- Animation JS -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('[data-fade]').forEach(el => {
                setTimeout(() => el.classList.add('show'), 200);
            });
        });
    </script>
</body>
</html>
