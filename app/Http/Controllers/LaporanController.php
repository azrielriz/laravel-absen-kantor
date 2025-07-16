<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;
use App\Models\Cuti;
use App\Models\Pengumuman;

class LaporanController extends Controller
{
    public function index(Request $request)
{
    $query = Pengumuman::query();

    if ($request->filled('judul')) {
        $query->where('judul', 'like', '%' . $request->judul . '%');
    }

    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('tanggal', [$request->from, $request->to]);
    }

    $pengumumans = $query->latest()->get();
    return view('laporan.pengumuman', compact('pengumumans'));
}

    public function absen()
    {
    $absens = Absen::all();
    return view('laporan.absen', compact('absens'));
    }

    public function cuti()
    {
        $data = Cuti::latest()->get();
        return view('laporan.cuti', compact('data'));
    }

    public function pengumuman()
    {
        $data = Pengumuman::latest()->get();
        return view('laporan.pengumuman', compact('data'));
    }
}

