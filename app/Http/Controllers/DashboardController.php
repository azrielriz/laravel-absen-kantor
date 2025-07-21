<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Cuti;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 

class DashboardController extends Controller
{
    public function index()
{
    // Ambil total data dari masing-masing tabel
    $absenCount = Absen::count();
    $cutiCount = Cuti::count();
    $pengumumanCount = Pengumuman::count();

    // Default null
    $userCount = null;
    $pegawaiCount = null;

    // Ambil user dan pegawai berdasarkan role atau user_type
    if (Auth::check()) {
        if (Auth::user()->user_type === 'superadmin') {
            $userCount = User::where('user_type', 'admin')->count();
            $pegawaiCount = User::where('user_type', 'user')->count();
        } elseif (Auth::user()->user_type === 'admin') {
            $pegawaiCount = User::where('user_type', 'user')->count();
        }
    }

    // Kirim ke view
    return view('dashboard', compact('absenCount', 'cutiCount', 'pengumumanCount', 'userCount', 'pegawaiCount'));
}

}
