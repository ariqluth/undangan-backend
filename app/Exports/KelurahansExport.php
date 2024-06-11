<?php

namespace App\Exports;

use App\Models\Kelurahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KelurahansExport implements FromCollection,  WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kelurahan::select('kelurahan.id', 'kabupaten.nama_kabupaten',  'kecamatan.nama_kecamatan', 'kelurahan.nama_kelurahan', 'kelurahan.status')
            ->join('kabupaten', 'kelurahan.kabupaten_id', '=', 'kabupaten.id')
            ->join('kecamatan', 'kelurahan.kecamatan_id', '=', 'kecamatan.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kabupaten',
            'Nama Kecamatan',
            'Nama Kelurahan',
            'Status'
        ];
    }
}
