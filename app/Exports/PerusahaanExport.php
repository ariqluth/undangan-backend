<?php

namespace App\Exports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PerusahaanExport implements FromCollection,  WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Perusahaan::select(
            'perusahaan.nama_perusahaan',
            'perusahaan.nib',
            'penanaman_modal.status_pmdn',
            'uraian_jenis_perusahaan.nama_uraian_jenis_perusahaan',
            'perusahaan.alamat',
            'kabupaten.nama_kabupaten',
            'perusahaan.email',
            'perusahaan.no_telp'
        )
            ->leftJoin('kabupaten', 'perusahaan.kabupaten_id', '=', 'kabupaten.id')
            ->leftJoin('penanaman_modal', 'perusahaan.penanaman_modal_id', '=', 'penanaman_modal.id')
            ->leftJoin('uraian_jenis_perusahaan', 'perusahaan.uraian_jenis_perusahaan_id', '=', 'uraian_jenis_perusahaan.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Nama Perusahaan',
            'NIB',
            'Status Penanaman Modal',
            'Uraian Jenis Perusahaan',
            'Alamat Perusahaan',
            'Kab Kota',
            'Email',
            'Nomor Telp',
        ];
    }
}
