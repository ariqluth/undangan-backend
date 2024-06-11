<?php

namespace App\Imports;

use App\Models\Kbli;
use App\Models\Perusahaan;
use App\Models\StatusPerusahaan;
use App\Models\UraianJenisPerusahaan;
use App\Models\UraianResikoProyek;
use App\Models\UraianSkalaUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class StatusPerusahaanImport implements ToModel, WithHeadingRow, WithUpserts
// class StatusPerusahaanImport implements ToModel, WithHeadingRow
{

    protected $perusahaans;
    protected $uraian_jenis_perusahaans;
    protected $kblis;
    protected $uraian_resiko_proyeks;
    protected $uraian_skala_usahas;

    public function __construct()
    {
        $this->perusahaans = Perusahaan::select('id', 'nama_perusahaan')->get();
        $this->uraian_jenis_perusahaans = UraianJenisPerusahaan::select('id', 'nama_uraian_jenis_perusahaan')->get();
        $this->kblis = Kbli::all();
        $this->uraian_resiko_proyeks = UraianResikoProyek::select('id', 'nama_uraian_resiko_proyek')->get();
        $this->uraian_skala_usahas = UraianSkalaUsaha::select('id', 'nama_uraian_skala_usaha')->get();
    }

    public function model(array $row)
    {
        $perusahaan = $this->perusahaans->where('nama_perusahaan', $row['nama_perusahaan'])->first();
        $kbli = $this->kblis->where('kbli', $row['kbli'])->first();
        $uraian_jenis_perusahaan = $this->uraian_jenis_perusahaans->where('nama_uraian_jenis_perusahaan', $row['nama_uraian_jenis_perusahaan'])->first();
        $uraian_resiko_proyek = $this->uraian_resiko_proyeks->where('nama_uraian_resiko_proyek', $row['nama_uraian_resiko_proyek'])->first();
        $uraian_skala_usaha = $this->uraian_skala_usahas->where('nama_uraian_skala_usaha', $row['nama_uraian_skala_usaha'])->first();


        return new StatusPerusahaan([
            'perusahaan_id' => $perusahaan->id ?? null,
            'pmdn' => $row['pmdn'],
            'uraian_jenis_perusahaan_id' => $uraian_jenis_perusahaan->id ?? null,
            'kbli_id' => $kbli->id ?? null,
            'uraian_resiko_proyek_id' => $uraian_resiko_proyek->id ?? null,
            'uraian_skala_usaha_id' => $uraian_skala_usaha->id ?? null,
        ]);
    }

    public function uniqueBy()
    {
        return 'kbli_id';
    }
}
