@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Akun Admin</h2>

    <form method="POST" action="{{ route('users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>Cabang</label>
            <select name="cabang_id" class="form-control" required>
                <option value="">-- Pilih Cabang --</option>
                @foreach ($cabangs as $cabang)
                    <option value="{{ $cabang->id }}" {{ $user->cabang_id == $cabang->id ? 'selected' : '' }}>
                        {{ $cabang->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}">
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $user->jabatan) }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
