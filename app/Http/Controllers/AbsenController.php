<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absen;


class AbsenController extends Controller
{
    public function index(Request $request)
{
    $query = Absen::query();

    // Filter nama
    if ($request->filled('username')) {
        $query->where('username', 'like', '%' . $request->username . '%');
    }

    // Filter tanggal
    if ($request->filled('from') && $request->filled('to')) {
        $query->whereBetween('tanggal', [$request->from, $request->to]);
    }

    $absens = $query->latest()->get();

    return view('laporan.absen', compact('absens'));
}

    public function store(Request $request)
{
    $validated = $request->validate([
        'username' => 'required|string',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'status' => 'required',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png',
        'keterangan' => 'nullable|string',
    ]);

    // Simpan foto kalau ada
    if ($request->hasFile('foto')) {
        $file = $request->file('foto');
        $filename = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('absen_foto', $filename, 'public');
        $validated['foto'] = $path;
    }

    // Simpan ke database
    Absen::create($validated);
    \Log::info('Data absen:', $validated);


    return response()->json(['message' => 'Data absen berhasil disimpan'], 201);
}
}