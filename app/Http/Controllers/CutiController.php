<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CutiExport;
use App\Models\Cuti;

class CutiController extends Controller
{
    // ✅ Export ke PDF
    public function exportPDF()
    {
        $cutis = Cuti::all();
        $pdf = PDF::loadView('exports.cuti_pdf', compact('cutis'));
        return $pdf->download('laporan_cuti.pdf');
    }

    // ✅ Export ke Excel
    public function exportExcel()
    {
        return Excel::download(new CutiExport, 'laporan_cuti.xlsx');
    }

    // ✅ Tampilkan data cuti (dengan filter)
    public function index(Request $request)
    {
        $query = Cuti::query();

        // Filter nama
        if ($request->filled('nama')) {
            $query->where('nama', 'like', '%' . $request->nama . '%');
        }

        // Filter tanggal
        if ($request->filled('from') && $request->filled('to')) {
            $query->whereBetween('tanggal_mulai', [$request->from, $request->to]);
        }

        $cutis = $query->latest()->get();

        return view('laporan.cuti', compact('cutis'));
    }

    // ✅ Simpan data cuti dari Android/API
    public function store(Request $request)
    {
        \Log::info('Request dari Android:', $request->all());

        try {
            $validated = $request->validate([
                'username' => 'required|string',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date',
                'alasan' => 'required|string',
                'jumlah_hari' => 'required|integer|min:1|max:12',
            ]);

            $cuti = Cuti::create($validated);

            \Log::info('Cuti berhasil disimpan:', $cuti->toArray());

            return response()->json([
                'message' => 'Cuti berhasil disimpan',
                'data' => $cuti
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan cuti: ' . $e->getMessage());
            return response()->json([
                'message' => 'Terjadi kesalahan server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
