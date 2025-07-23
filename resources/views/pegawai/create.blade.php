@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pegawai</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pegawai.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name">Nama</label>
            <input name="name" id="name" class="form-control" value="{{ old('name') }}">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input name="email" id="email" class="form-control" type="email" value="{{ old('email') }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input name="password" id="password" class="form-control" type="password">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="jabatan">Jabatan</label>
            <input name="jabatan" id="jabatan" class="form-control" value="{{ old('jabatan') }}">
            @error('jabatan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="no_hp">No HP</label>
            <input name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp') }}">
            @error('no_hp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

       <div class="mb-3">
    <label for="cabang_id">Cabang</label>
    <select name="cabang_id" id="cabang_id" class="form-control">
        <option value="">-- Pilih Cabang --</option>
        @foreach($cabangs as $cabang)
           <option value="{{ $cabang->id }}"
    {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
    {{ $cabang->nama_cabang }}
</option>

        @endforeach
    </select>
    @error('cabang_id') <small class="text-danger">{{ $message }}</small> @enderror
</div>



        <div class="mt-4">
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
