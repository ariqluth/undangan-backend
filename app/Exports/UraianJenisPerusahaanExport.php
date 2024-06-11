<?php

namespace App\Exports;

use App\Models\UraianJenisPerusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UraianJenisPerusahaanExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return UraianJenisPerusahaan::select('nama_uraian_jenis_perusahaan')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Uraian Jenis Perusahaan',
        ];
    }
}
