<?php

namespace App\Exports;

use App\Models\KbliPerusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArtikelExport implements FromCollection,  WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KbliPerusahaan::Select(
            'artikel.judul',
            'artikel.id',
            'artikel.thumbnail',
            'users.name as name',
            'kategori_artikel.nama_kategori as kategori',
            'kategori_artikel.slug as slug',
        )
        ->leftjoin('users', 'artikel.penerbit_id', '=', 'users.id')
        ->leftjoin('kategori_artikel', 'artikel.kategori_id', '=', 'kategori_artikel.id')
        ->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'judul',
            'Gambar',
            'Penerbit',
            'Kategori',
            'Slug',
        ];
    }
}
