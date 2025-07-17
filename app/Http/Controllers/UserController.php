<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Tampilkan semua admin
public function index()
{
    $users = User::where('role', 'admin')->get();
    return view('laporan.users.index', compact('users'));
}

// Tampilkan form tambah admin
public function create()
{
    return view('laporan.users.create');
}

// Simpan admin baru
public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        'cabang' => 'required'
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 'admin',
        'cabang' => $request->cabang,
    ]);

    return redirect()->route('users.index')->with('success', 'Akun admin berhasil ditambahkan.');
}

// Tampilkan form edit
public function edit(User $user)
{
    return view('laporan.users.edit', compact('user'));
}

// Update admin
public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'cabang' => 'required',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'cabang' => $request->cabang,
    ]);

    return redirect()->route('users.index')->with('success', 'Akun admin diperbarui.');
}

// Hapus admin
public function destroy(User $user)
{
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Akun admin dihapus.');
}

}
