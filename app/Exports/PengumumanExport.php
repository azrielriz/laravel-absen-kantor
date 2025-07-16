<?php

namespace App\Exports;

use App\Models\Pengumuman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengumumanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengumuman::select('judul', 'tanggal', 'keterangan')->get();
    }

    public function headings(): array
    {
        return ['Judul', 'Tanggal', 'Keterangan'];
    }
}
