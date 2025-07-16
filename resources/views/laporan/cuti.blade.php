@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Laporan Cuti</h2>

    {{-- Filter Form --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="nama" class="form-control" placeholder="Cari Nama..." value="{{ request('nama') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="from" class="form-control" value="{{ request('from') }}">
        </div>
        <div class="col-md-3">
            <input type="date" name="to" class="form-control" value="{{ request('to') }}">
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-primary">🔍 Filter</button>
        </div>
    </form>

    {{-- Export Buttons --}}
    <div class="mb-3">
        <a href="{{ route('laporan.cuti.pdf') }}" class="btn btn-danger">📄 Export PDF</a>
        <a href="{{ route('laporan.cuti.excel') }}" class="btn btn-success">📊 Export Excel</a>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jumlah Hari</th>
                    <th>Alasan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cutis as $cuti)
                    <tr>
                        <td>{{ $cuti->username}}</td>
                        <td>{{ $cuti->tanggal_mulai }}</td>
                        <td>{{ $cuti->tanggal_selesai }}</td>
                        <td>{{ $cuti->jumlah_hari }}</td>
                        <td>{{ $cuti->alasan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Tidak ada data cuti</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
