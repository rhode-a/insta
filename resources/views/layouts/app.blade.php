<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>T.T.G Network - @yield('title', 'Dashboard')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('preinscriptions.index') }}"><i class="bi bi-pencil-square"></i> Préinscription</a></li>
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
<footer class="bg-white border-top py-3 text-center small text-muted">
    &copy; {{ date('Y') }} T.T.G Network. Tous droits réservés.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
