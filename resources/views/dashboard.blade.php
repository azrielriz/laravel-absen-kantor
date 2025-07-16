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

    {{-- Authenticated Message --}}
    @auth
        <div class="alert alert-success">
            Anda berhasil login sebagai <strong>{{ auth()->user()->name }}</strong>
        </div>

        {{-- Admin Panel --}}
        @role('admin')
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    <i class="fas fa-user-shield"></i> Panel Admin
                </div>
                <div class="card-body">
                    <p>Anda memiliki hak akses sebagai <strong>Admin</strong>.</p>
                    <ul>
                        <li>Mengelola pengguna</li>
                        <li>Mengelola laporan</li>
                        <li>Akses penuh ke seluruh sistem</li>
                    </ul>
                </div>
            </div>
        @endrole

        {{-- User Panel --}}
        @role('user')
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-user"></i> Panel Pengguna
                </div>
                <div class="card-body">
                    <p>Anda login sebagai <strong>Pengguna Biasa</strong>.</p>
                    <ul>
                        <li>Melihat laporan pribadi</li>
                        <li>Mengajukan cuti</li>
                    </ul>
                </div>
            </div>
        @endrole

        {{-- Permission Info --}}
        @can('manage laporan')
            <div class="alert alert-info">
                Anda memiliki izin untuk <strong>mengelola laporan</strong>.
            </div>
        @endcan
    @endauth

    {{-- Statistik Laporan --}}
    <div class="row mt-4">
        {{-- Box Absen --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $absenCount }}</h3>
                    <p>Total Absen</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('laporan.absen') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Box Cuti --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $cutiCount }}</h3>
                    <p>Total Cuti</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-minus"></i>
                </div>
                <a href="{{ route('laporan.cuti') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- Box Pengumuman --}}
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $pengumumanCount }}</h3>
                    <p>Total Pengumuman</p>
                </div>
                <div class="icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <a href="{{ route('laporan.pengumuman') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

</div>
@stop
