<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>T.T.G Network - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <style>
        body {
            background: linear-gradient(to right, #eef2f3, #ffffff);
        }

        .navbar {
            background: linear-gradient(90deg, #0d6efd, #6610f2);
        }

        .navbar .nav-link {
            color: #ffffff !important;
            font-weight: 500;
        }

        .navbar .nav-link:hover {
            color: #ffd700 !important;
            text-shadow: 0 0 2px #fff;
        }

        .navbar-brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff !important;
        }

        .container main {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }

        .alert {
            border-radius: 8px;
            font-size: 0.95rem;
        }

        footer {
            background: #f1f3f5;
            border-top: 1px solid #dee2e6;
            padding: 1rem;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .btn-link {
            color: #fff !important;
            padding: 0;
            margin-left: 1rem;
        }

        .btn-link:hover {
            color: #ffc107 !important;
            text-decoration: none;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="bi bi-mortarboard"></i> T.T.G Network
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            @auth
                <ul class="navbar-nav ms-auto align-items-center">
                    @php $role = auth()->user()->role; @endphp

                    @if($role === 'admin')
                        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('preinscriptions.index') }}"><i class="bi bi-card-list"></i> Préinscriptions</a></li>
                    @elseif($role === 'etudiant')
                        <li class="nav-item"><a class="nav-link" href="{{ route('etudiant.dashboard') }}"><i class="bi bi-house-door"></i> Dashboard</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('preinscription.formulaire') }}"><i class="bi bi-pencil-square"></i> Préinscription</a></li>
                    @elseif($role === 'formateur')
                        <li class="nav-item"><a class="nav-link" href="{{ route('formateur.dashboard') }}"><i class="bi bi-person-badge"></i> Formateur</a></li>
                    @elseif($role === 'parent')
                        <li class="nav-item"><a class="nav-link" href="{{ route('parent.dashboard') }}"><i class="bi bi-people"></i> Parent</a></li>
                    @endif

                    <li class="nav-item"><a class="nav-link" href="{{ route('profile.show', auth()->id()) }}"><i class="bi bi-person-circle"></i> Mon profil</a></li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-link nav-link" type="submit"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                        </form>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Inscription</a></li>
                </ul>
            @endauth
        </div>
    </div>
</nav>

<!-- Main content -->
<main class="container my-5">
    @if(session('success'))
        <div class="alert alert-success shadow-sm"><i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shadow-sm"><i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<!-- Footer -->
<footer class="text-center small">
    &copy; {{ date('Y') }} T.T.G Network. Tous droits réservés.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
