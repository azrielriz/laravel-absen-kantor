<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            // Superadmin bisa lihat semua pegawai
            $pegawais = User::where('role', 'user')->with('cabang')->get();
        } else {
            // Admin hanya bisa lihat pegawai di cabangnya
            $pegawais = User::where('role', 'user')
                ->where('cabang_id', $user->cabang_id)
                ->with('cabang')
                ->get();
        }

        return view('pegawai.index', compact('pegawais'));
    }

    public function create()
    {
        // Hanya superadmin yang boleh menambahkan pegawai
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki akses');
        }

        $cabangs = Cabang::all();
        return view('pegawai.create', compact('cabangs'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Tidak memiliki akses');
        }

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'jabatan'   => 'required|string|max:255',
            'no_hp'     => 'required|string|max:15',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'jabatan'   => $request->jabatan,
            'no_hp'     => $request->no_hp,
            'role'      => 'user',
            'cabang_id' => $request->cabang_id,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(User $pegawai)
    {
        $this->authorizeAccess($pegawai); // validasi admin & cabang

        $cabangs = Cabang::all();
        return view('pegawai.edit', compact('pegawai', 'cabangs'));
    }

    public function update(Request $request, User $pegawai)
    {
        $this->authorizeAccess($pegawai); // validasi admin & cabang

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $pegawai->id,
            'jabatan'   => 'required|string|max:255',
            'no_hp'     => 'required|string|max:15',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        $pegawai->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'jabatan'   => $request->jabatan,
            'no_hp'     => $request->no_hp,
            'cabang_id' => $request->cabang_id,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diupdate.');
    }

    public function destroy(User $pegawai)
    {
        $this->authorizeAccess($pegawai); // validasi admin & cabang

        $pegawai->delete();
        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    /**
     * Cek akses hanya jika admin & hanya untuk cabangnya sendiri
     */
    protected function authorizeAccess(User $pegawai)
    {
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return true;
        }

        if ($user->role === 'admin' && $pegawai->cabang_id === $user->cabang_id) {
            return true;
        }

        abort(403, 'Anda tidak memiliki akses ke data ini.');
    }
}
