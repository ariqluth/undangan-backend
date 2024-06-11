<?php

namespace App\Exports;

use App\Models\Kabupaten;
use App\Models\Kbli;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KblisExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Kbli::Select('kbli', 'judul_kbli', 'sektor')->get();
    }

    public function headings(): array
    {
        return [
            'Kbli',
            'Judul Kbli',
            'Sektor',
        ];
    }
}
