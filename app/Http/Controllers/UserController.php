<?php

namespace App\Http\Controllers; // ✅ Wajib ada agar Laravel tahu ini controller

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; // ✅ Ini yang kamu lupa

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'admin')->with('cabang')->get(); // relasi cabang
        return view('laporan.users.index', compact('users'));
    }

    public function create()
    {
        return view('laporan.users.create'); // input cabang tetap teks biasa
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cabang' => 'required'
        ]);

        // Buat atau ambil cabang sesuai input
        $cabang = Cabang::firstOrCreate([
            'nama' => $request->cabang
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'cabang_id' => $cabang->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun admin berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('laporan.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'cabang' => 'required',
        ]);

        // Buat atau ambil cabang sesuai input
        $cabang = Cabang::firstOrCreate([
            'nama' => $request->cabang
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'cabang_id' => $cabang->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun admin diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun admin dihapus.');
    }
}
