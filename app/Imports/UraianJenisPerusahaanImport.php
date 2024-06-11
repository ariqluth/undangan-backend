<?php

namespace App\Imports;

use App\Models\UraianJenisPerusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UraianJenisPerusahaanImport implements ToModel, WithHeadingRow, WithUpserts

{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UraianJenisPerusahaan([
            'nama_uraian_jenis_perusahaan' => $row['nama_uraian_jenis_perusahaan'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_uraian_jenis_perusahaan';
    }
}
