<?php

namespace App\Exports;

use App\Models\ProfilePengusaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ProfilePengusahaExport implements FromCollection,  WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return ProfilePengusaha::Select('nomor_identitas_user', 'nama_pengusaha', 'no_telp', 'email')->get();
    }

    public function headings(): array
    {
        return [
            'Nomor Identitas User',
            'Nama Pengusaha',
            'Nomor Telpon',
            'Email'
        ];
    }
}
