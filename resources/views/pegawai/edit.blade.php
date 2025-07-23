@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pegawai</h1>

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}">
            @error('name')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $pegawai->email }}">
            @error('email')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" class="form-control" value="{{ $pegawai->jabatan }}">
            @error('jabatan')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" value="{{ $pegawai->no_hp }}">
            @error('no_hp')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <div class="mb-3">
            <label>Cabang</label>
            <select name="cabang_id" class="form-control">
                @foreach ($cabangs as $cabang)
                    <option value="{{ $cabang->id }}" {{ $pegawai->cabang_id == $cabang->id ? 'selected' : '' }}>
                        {{ $cabang->nama }}
                    </option>
                @endforeach
            </select>
            @error('cabang_id')<small class="text-danger">{{ $message }}</small>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
