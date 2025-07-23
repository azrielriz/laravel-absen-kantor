@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pegawai</h1>

    <a href="{{ route('pegawai.create') }}" class="btn btn-primary mb-3">+ Tambah Pegawai</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>No HP</th>
                    <th>Cabang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pegawais as $pegawai)
                    <tr>
                        <td>{{ $pegawai->name }}</td>
                        <td>{{ $pegawai->email }}</td>
                        <td>{{ $pegawai->jabatan ?? '-' }}</td>
                        <td>{{ $pegawai->no_hp ?? '-' }}</td>
                         <td>{{ $pegawai->cabang?->nama_cabang ?? '-' }}</td>

                        <td>
                            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pegawai ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada pegawai.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
