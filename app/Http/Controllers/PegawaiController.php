<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request; // ✅ Tambahkan ini!
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = User::where('role', 'user')->with('cabang')->get();
        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        $cabangs = Cabang::all();
        return view('pegawai.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'cabang_id' => $request->cabang_id,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(User $pegawai)
    {
        $cabangs = Cabang::all();
        return view('pegawai.edit', compact('pegawai', 'cabangs'));
    }

    public function update(Request $request, User $pegawai)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $pegawai->id,
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        $pegawai->update([
            'name' => $request->name,
            'email' => $request->email,
            'cabang_id' => $request->cabang_id,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate.');
    }

    public function destroy(User $pegawai)
    {
        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }
}
