<?php

namespace App\Exports;

use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KecamatansExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    public function collection()
    {
        return Kecamatan::select('kecamatan.id', 'nama_kecamatan', 'kabupaten.nama_kabupaten')
            ->join('kabupaten', 'kecamatan.kabupaten_id', '=', 'kabupaten.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kecamatan',
            'Nama Kabupaten'
        ];
    }
}
