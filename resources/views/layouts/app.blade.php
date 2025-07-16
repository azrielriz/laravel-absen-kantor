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
            background-color: #f8f9fa;
            margin: 0;
        }
        .sidebar {
            background-color: #343a40;
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
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="text-center text-white">
            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none">Dashboard</a>
        </h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('laporan.absen') }}" class="nav-link">
                    <i class="fas fa-user-check"></i> Laporan Absen
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('laporan.cuti') }}" class="nav-link">
                    <i class="fas fa-calendar-alt"></i> Laporan Cuti
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('laporan.pengumuman') }}" class="nav-link">
                    <i class="fas fa-bullhorn"></i> Laporan Pengumuman
                </a>
            </li>
            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-white p-0">
                        <i class="fas fa-sign-out-alt"></i> Logout
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
