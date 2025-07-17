{{-- resources/views/dashboard.blade.php --}}
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-0">Dashboard</h1>
    <form action="{{ route('logout') }}" method="POST" class="mb-0">
        @csrf
        <button type="submit" class="btn btn-danger fw-bold">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</div>
@stop

@section('content')
<div class="container-fluid">

    {{-- Pesan jika berhasil login --}}
    @auth
        <div class="alert alert-success">
            Anda berhasil login sebagai <strong>{{ auth()->user()->name }}</strong>
        </div>

        {{-- Panel Super Admin --}}
        @if(auth()->user()->user_type == 'superadmin')
            <div class="card mb-3">
                <div class="card-header bg-danger text-white">
                    <i class="fas fa-crown"></i> Panel Super Admin
                </div>
                <div class="card-body">
                    <p>Anda login sebagai <strong>Super Admin</strong>.</p>
                    <ul>
                        <li>Akses penuh ke semua fitur sistem</li>
                        <li>Manajemen user (admin & user)</li>
                        <li>Kontrol penuh terhadap laporan dan pengumuman</li>
                    </ul>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-dark mt-2">
                        <i class="fas fa-users-cog"></i> Manajemen User
                    </a>
                </div>
            </div>
        @endif

        {{-- Panel Admin --}}
        @if(auth()->user()->user_type == 'admin')
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-user-shield"></i> Panel Admin
                </div>
                <div class="card-body">
                    <p>Anda login sebagai <strong>Admin</strong>.</p>
                    <ul>
                        <li>Mengelola pengguna</li>
                        <li>Mengelola laporan</li>
                        <li>Akses penuh ke seluruh sistem</li>
                    </ul>
                </div>
            </div>
        @endif

        {{-- Informasi izin --}}
        @can('manage laporan')
            <div class="alert alert-info">
                Anda memiliki izin untuk <strong>mengelola laporan</strong>.
            </div>
        @endcan
    @endauth

    {{-- Statistik Dashboard --}}
    <div class="row mt-4">

        {{-- Box Total Absen --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background: linear-gradient(to right, #00b09b, #96c93d);">
                <div class="inner">
                    <h3>{{ $absenCount ?? 0 }}</h3>
                    <p>Total Absen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('laporan.absen') }}" class="small-box-footer text-white">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Box Total Cuti --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background: linear-gradient(to right, #f7971e, #ffd200);">
                <div class="inner">
                    <h3>{{ $cutiCount ?? 0 }}</h3>
                    <p>Total Cuti</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-minus"></i>
                </div>
                <a href="{{ route('laporan.cuti') }}" class="small-box-footer text-white">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Box Total Pengumuman --}}
        <div class="col-lg-3 col-6">
            <div class="small-box text-white" style="background: linear-gradient(to right, #396afc, #2948ff);">
                <div class="inner">
                    <h3>{{ $pengumumanCount ?? 0 }}</h3>
                    <p>Total Pengumuman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <a href="{{ route('laporan.pengumuman') }}" class="small-box-footer text-white">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Box Manajemen User (Hanya Superadmin) --}}
        @if(auth()->user()->user_type == 'superadmin')
            <div class="col-lg-3 col-6">
                <div class="small-box text-white" style="background: linear-gradient(to right, #8e2de2, #4a00e0);">
                    <div class="inner">
                        <h3>{{ $userCount ?? 0 }}</h3>
                        <p>Manajemen User</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <a href="{{ route('users.index') }}" class="small-box-footer text-white">
                        Kelola User <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
        @endif

    </div>
</div>
@stop
