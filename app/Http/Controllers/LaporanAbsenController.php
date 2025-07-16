<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class LaporanAbsenController extends Controller
{
public function index()
    {
        $absens = Absen::all();
        return view('laporan.absen', compact('absens'));
    }

    // Method untuk export PDF
    public function exportPdf()
    {
        $absens = Absen::all();
        $pdf = \PDF::loadView('laporan.absen_pdf', compact('absens'));
        return $pdf->download('laporan_absen.pdf');
    }

    // Method untuk export Excel
    public function exportExcel()
    {
        return \Excel::download(new \App\Exports\AbsenExport, 'laporan_absen.xlsx');
    }
}
