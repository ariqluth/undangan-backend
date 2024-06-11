<?php

namespace App\Imports;

use App\Models\UraianSkalaUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UraianSkalaUsahaImport implements ToModel, WithHeadingRow,WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UraianSkalaUsaha([
            'nama_uraian_skala_usaha' => $row['nama_uraian_skala_usaha'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_uraian_skala_usaha';
    }
}
