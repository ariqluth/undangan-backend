<?php

namespace App\Imports;

use App\Models\Kabupaten;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KabupatensImport implements ToModel, WithHeadingRow, WithUpserts
{
    public function model(array $row)
    {
        return new Kabupaten([
            'nama_kabupaten' => $row['nama_kabupaten'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_kabupaten';
    }
}
