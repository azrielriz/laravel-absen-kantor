<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengumumanExport;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::latest()->get();
        return view('laporan.pengumuman', compact('pengumumans'));
    }

    public function exportPDF()
    {
        $pengumumans = Pengumuman::all();
        $pdf = PDF::loadView('exports.pengumuman_pdf', compact('pengumumans'));
        return $pdf->download('laporan_pengumuman.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new PengumumanExport, 'laporan_pengumuman.xlsx');
    }
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'required'
    ]);

    Pengumuman::create($request->all());

    return response()->json(['message' => 'Pengumuman berhasil disimpan']);
}

}
