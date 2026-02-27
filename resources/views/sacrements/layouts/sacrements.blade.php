<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Gestion des Sacrements') — Paroisse Saint-Esprit de Bépanda</title>

    <!-- Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --color-primary: #1a685b;
            --color-accent:  #C0392B;
            --color-bg:     #fdfdea;
        }

        body {
            background-color: var(--color-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ── Top Navbar ── */
        .top-navbar {
            background-color: var(--color-primary);
            color: #fff;
            height: 60px;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1040;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,.3);
        }
        .top-navbar .brand {
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .top-navbar .brand .cross {
            color: var(--color-accent);
            font-size: 1.4rem;
        }
        .top-navbar .user-section {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .top-navbar .user-section a {
            color: rgba(255,255,255,.85);
            text-decoration: none;
            font-size: .9rem;
        }
        .top-navbar .user-section a:hover { color: #fff; }

        /* ── Sidebar ── */
        .sidebar {
            background-color: var(--color-primary);
            width: 240px;
            position: fixed;
            top: 60px; left: 0; bottom: 0;
            overflow-y: auto;
            z-index: 1030;
            padding: 1rem 0;
        }
        .sidebar .nav-section-title {
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,.45);
            padding: .5rem 1.2rem .2rem;
            margin-top: .5rem;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: .55rem 1.2rem;
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: .7rem;
            font-size: .9rem;
            transition: background .15s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,.12);
            color: #fff;
            border-left: 3px solid var(--color-accent);
        }
        .sidebar .nav-link i { font-size: 1.05rem; }

        /* ── Main Content ── */
        .main-content {
            margin-left: 240px;
            margin-top: 60px;
            min-height: calc(100vh - 60px);
            padding: 1.5rem;
        }

        /* ── Cards ── */
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .stat-card { border-left: 4px solid var(--color-primary); }
        .stat-card.accent { border-left-color: var(--color-accent); }

        /* ── Badges ── */
        .badge-inscrit    { background-color: #0d6efd; }
        .badge-en_cours   { background-color: #198754; }
        .badge-suspendu   { background-color: #fd7e14; }
        .badge-diplome    { background-color: #0dcaf0; }
        .badge-abandonne  { background-color: #dc3545; }

        /* ── Buttons ── */
        .btn-primary-custom {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: #fff;
        }
        .btn-primary-custom:hover {
            background-color: #14306b;
            border-color: #14306b;
            color: #fff;
        }
        .btn-danger-custom {
            background-color: var(--color-accent);
            border-color: var(--color-accent);
            color: #fff;
        }

        /* ── Breadcrumb ── */
        .breadcrumb { background: transparent; padding: 0; margin-bottom: 1rem; }

        /* ── Footer ── */
        .site-footer {
            text-align: center;
            padding: 1rem;
            color: #888;
            font-size: .8rem;
            margin-top: 2rem;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar { display: none; }
            .main-content { margin-left: 0; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- Top Navbar -->
<nav class="top-navbar">
    <a style="color: #e68908 " class="brand" href="{{ route('sacrements.dashboard') }}">
         <img src="{{ asset('charitize/img/logo.png') }}" alt="Logo Saint-Esprit Bepanda" width="5%"><i class="bi bi-cross cross"></i>
        Paroisse Saint-Esprit — Sacrements
    </a>
    <div class="user-section">
        @auth
        <span class="text-white-50 small d-none d-md-inline">
            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
        </span>
        <a href="{{ route('home') }}">
            <i class="bi bi-house"></i> Accueil
        </a>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Déconnexion
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        @endauth
    </div>
</nav>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="nav-section-title">Navigation</div>

    <a class="nav-link {{ request()->routeIs('sacrements.dashboard') ? 'active' : '' }}"
       href="{{ route('sacrements.dashboard') }}">
        <i class="bi bi-speedometer2"></i> Tableau de bord
    </a>

    <div class="nav-section-title">Catéchumènes</div>
    <a class="nav-link {{ request()->routeIs('sacrements.catechumenes.*') ? 'active' : '' }}"
       href="{{ route('sacrements.catechumenes.index') }}">
        <i class="bi bi-people-fill"></i> Catéchumènes
    </a>
    <a class="nav-link {{ request()->routeIs('sacrements.groupes.*') ? 'active' : '' }}"
       href="{{ route('sacrements.groupes.index') }}">
        <i class="bi bi-collection"></i> Groupes
    </a>
    <a class="nav-link {{ request()->routeIs('sacrements.catechistes.*') ? 'active' : '' }}"
       href="{{ route('sacrements.catechistes.index') }}">
        <i class="bi bi-person-badge"></i> Catéchistes
    </a>

    <div class="nav-section-title">Pédagogie</div>
    <a class="nav-link {{ request()->routeIs('sacrements.niveaux.*') ? 'active' : '' }}"
       href="{{ route('sacrements.niveaux.index') }}">
        <i class="bi bi-layers"></i> Niveaux
    </a>
    <a class="nav-link {{ request()->routeIs('sacrements.cours.*') ? 'active' : '' }}"
       href="{{ route('sacrements.cours.index') }}">
        <i class="bi bi-book"></i> Cours
    </a>
    <a class="nav-link {{ request()->routeIs('sacrements.examens.*') ? 'active' : '' }}"
       href="{{ route('sacrements.examens.index') }}">
        <i class="bi bi-pencil-square"></i> Examens
    </a>
</aside>

<!-- Main Content -->
<main class="main-content">
    {{-- Flash Messages --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <strong>Des erreurs ont été détectées :</strong>
        <ul class="mb-0 mt-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    @yield('content')

    <footer class="site-footer">
        Paroisse Saint-Esprit de Bépanda &copy; {{ date('Y') }} — Archidiocèse de Douala
    </footer>
</main>

<!-- Bootstrap 5.3 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@yield('scripts')
</body>
</html>
