@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Laporan Absen</h2>

    {{-- Filter Form --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="username" class="form-control" placeholder="Cari Nama..." value="{{ request('username') }}">
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
        <a href="{{ route('laporan.absen.pdf') }}" class="btn btn-danger">📄 Export PDF</a>
        <a href="{{ route('laporan.absen.excel') }}" class="btn btn-success">📊 Export Excel</a>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Foto</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absens as $absen)
                    <tr>
                        <td>{{ $absen->username }}</td>
                        <td>{{ $absen->tanggal }}</td>
                        <td>{{ $absen->jam }}</td>
                        <td>{{ $absen->status }}</td>
                        <td>{{ $absen->keterangan ?? '-' }}</td>
                        <td>
                           @if ($absen->foto)
                             <img src="{{ asset('storage/' . $absen->foto) }}" width="70" alt="foto">

                            @else
                                 <span>Tidak ada foto</span>
                            @endif

                        </td>
                        <td>
                            @if ($absen->latitude && $absen->longitude)
                           <a href="https://www.google.com/maps?q={{ $absen->latitude }},{{ $absen->longitude }}" target="_blank">
                             📍 Lihat Lokasi
                            </a>
                            @else
                                 -
                             @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data absen</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

