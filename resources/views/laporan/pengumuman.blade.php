@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Laporan Pengumuman</h2>

    <div class="mb-3">
        <a href="{{ route('laporan.pengumuman.pdf') }}" class="btn btn-danger">Export PDF</a>
        <a href="{{ route('laporan.pengumuman.excel') }}" class="btn btn-success">Export Excel</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengumumans as $item)
                <tr>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->tanggal }}</td>
                    <td>{{ $item->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
