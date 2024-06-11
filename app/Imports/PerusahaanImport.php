<?php

namespace App\Imports;

use App\Models\Kabupaten;
use App\Models\PenanamanModal;
use App\Models\Perusahaan;
use App\Models\UraianJenisPerusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PerusahaanImport implements ToModel, WithHeadingRow, WithUpserts
{

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    protected $penanaman_modal;
    protected $uraian_jenis_perusahaan;
    protected $kabupaten;
    public function __construct()
    {
        set_time_limit(120);
        ini_set('memory_limit', '512M');
        $this->penanaman_modal = PenanamanModal::select('id', 'status_pmdn')->get();
        $this->uraian_jenis_perusahaan = UraianJenisPerusahaan::select('id', 'nama_uraian_jenis_perusahaan')->get();
        $this->kabupaten = Kabupaten::select('id', \DB::raw("REPLACE(nama_kabupaten, 'Kab. ', '') AS nama_kabupaten"))->get();
    }


    public function model(array $row)
    {
        $kabupaten = $this->kabupaten->where('nama_kabupaten', str_replace('Kab. ', '', $row['kab_kota']))->first();
        $penanaman_modal = $this->penanaman_modal->where('status_pmdn', $row['status_penanaman_modal'])->first();
        $uraian_jenis_perusahaan = $this->uraian_jenis_perusahaan->where('nama_uraian_jenis_perusahaan', $row['uraian_jenis_perusahaan'])->first();
        return new Perusahaan([
            'nama_perusahaan' => $row['nama_perusahaan'],
            'nib' => $row['nib'],
            'penanaman_modal_id' => $penanaman_modal->id ?? null,
            'uraian_jenis_perusahaan_id' => $uraian_jenis_perusahaan->id ?? null,
            'kabupaten_id' => $kabupaten->id ?? null,
            'alamat' => $row['alamat_perusahaan'],
            'email' => $row['email'],
            'no_telp' => $row['nomor_telp'],
        ]);
    }

    public function headings(): array
    {
        return [
            'Nama Perusahaan',
            'Nib',
            'Uraian Status Penanaman Modal',
            'Uraian Jenis Perusahaan',
            'Kab Kota',
            'Alamat Perusahaan',
            'email',
            'nomor_telp',
        ];
    }

    public function uniqueBy()
    {
        return 'nib';
    }
}
