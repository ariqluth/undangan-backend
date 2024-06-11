<?php

namespace App\Imports;

use App\Models\JenisUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class JenisUsahasImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new JenisUsaha([
            'nama_jenis_usaha' => $row['nama_jenis_usaha'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_jenis_usaha';
    }
}
