@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Akun Admin</h2>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf

        <div class="mb-3">
            <label>Nama Admin</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

       <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label>Konfirmasi Password</label>
    <input type="password" name="password_confirmation" class="form-control" required>
</div>

       <div class="mb-3">
    <label for="cabang">Nama Cabang</label>
    <input type="text" name="cabang" class="form-control" value="{{ old('cabang', $user->cabang->nama_cabang ?? '') }}" required>
    @error('cabang') <small class="text-danger">{{ $message }}</small> @enderror
</div>


    

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
