<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
       $users = User::where('role', 'admin')
    ->with('cabang')
    ->get();


        return view('laporan.users.index', compact('users'));
    }

    public function create()
    {
        return view('laporan.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'cabang'                => 'required|string|max:255',
        ]);

        // ✅ Cari atau buat cabang berdasarkan nama_cabang (bukan 'nama')
        $cabang = Cabang::firstOrCreate(['nama_cabang' => $request->cabang]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'admin',
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
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'cabang' => 'required|string|max:255',
        ]);

        $cabang = Cabang::firstOrCreate(['nama_cabang' => $request->cabang]);

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'cabang_id' => $cabang->id,
        ]);

        return redirect()->route('users.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
