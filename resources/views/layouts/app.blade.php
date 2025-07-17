<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            background-color: #f8f9fa;
        }
        .sidebar {
            background: linear-gradient(180deg, #343a40 0%, #212529 100%);
            min-height: 100vh;
            width: 250px;
        }
        .sidebar .nav-link {
            color: #ffffff;
        }
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .content {
            padding: 20px;
            width: 100%;
        }
        .nav-title {
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-center text-white mb-4">
            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">Dashboard</a>
        </h4>
        <hr class="bg-secondary">

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('laporan.absen') }}" class="nav-link">
                    <i class="fas fa-user-check me-2"></i> Laporan Absen
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('laporan.cuti') }}" class="nav-link">
                    <i class="fas fa-calendar-alt me-2"></i> Laporan Cuti
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('laporan.pengumuman') }}" class="nav-link">
                    <i class="fas fa-bullhorn me-2"></i> Laporan Pengumuman
                </a>
            </li>

            @if (Auth::user() && Auth::user()->role === 'superadmin')
                <li class="nav-item mt-3">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="fas fa-users-cog me-2"></i> Manajemen User
                    </a>
                </li>
            @endif

            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-white p-0">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Konten -->
    <div class="content">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
