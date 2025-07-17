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

        // Tambahan: Hitung jumlah user kalau yang login adalah superadmin
        $userCount = null;
        if (Auth::check() && Auth::user()->user_type === 'superadmin') {
            $userCount = User::count();
        }

        // Kirim ke view
        return view('dashboard', compact('absenCount', 'cutiCount', 'pengumumanCount', 'userCount'));
    }
}
