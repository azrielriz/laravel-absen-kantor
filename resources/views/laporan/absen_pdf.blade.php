@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Laporan Absen</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($absens as $absen)
                    <tr>
                        <td>{{ $absen->nama }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->jam)->format('H:i') }}</td>
                        <td>
                            <span class="badge 
                                @if($absen->status == 'Hadir') bg-success 
                                @elseif($absen->status == 'Izin') bg-warning 
                                @elseif($absen->status == 'Sakit') bg-info 
                                @else bg-secondary 
                                @endif">
                                {{ $absen->status }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Belum ada data absen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
