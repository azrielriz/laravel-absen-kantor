<?php

namespace App\Exports;

use App\Models\Cuti;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CutiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Cuti::select('username', 'tanggal_mulai', 'tanggal_selesai', 'jumlah_hari', 'alasan')->get();
    }

    public function headings(): array
    {
        return ['Username', 'Tanggal Mulai', 'Tanggal Selesai', 'Jumlah Hari', 'Alasan'];
    }
}
