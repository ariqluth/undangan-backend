<?php

namespace App\Imports;

use App\Models\JenisLegalitas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JenisLegalitasImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JenisLegalitas([
            'nama_jenis_legalitas' => $row['nama_jenis_legalitas'],
        ]);
    }
}
