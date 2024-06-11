<?php

namespace App\Exports;

use App\Models\Kabupaten;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KabupatensExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kabupaten::Select('nama_kabupaten')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Kabupaten',
        ];
    }
}
