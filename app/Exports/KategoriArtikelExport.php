<?php

namespace App\Exports;

use App\Models\KategoriArtikel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KategoriArtikelExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KategoriArtikel::Select('nama_kategori')->get();
    }

    public function headings(): array
    {
        return [
            'nama_kategori'
        ];
    }
}
