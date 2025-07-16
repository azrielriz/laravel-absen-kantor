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
    $request->validate([
        'username' => 'required|string',
        'tanggal' => 'required|date',
        'jam' => 'required',
        'status' => 'required',
        'keterangan' => 'nullable|string',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

    $fotoPath = null;
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('absen_foto', 'public');
    }

    Absen::create([
        'username' => $request->username,
        'tanggal' => $request->tanggal,
        'jam' => $request->jam,
        'status' => $request->status,
        'keterangan' => $request->keterangan,
        'foto' => $fotoPath,
        'latitude' => $request->latitude,
        'longitude' => $request->longitude,
    ]);
     \Log::info($request->all());


    return response()->json(['message' => 'Data absen berhasil disimpan'], 201);
}
}
