<?php

namespace App\Imports;

use App\Models\UraianResikoProyek;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class UraianResikoProyekImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UraianResikoProyek([
            'nama_uraian_resiko_proyek' => $row['nama_uraian_resiko_proyek'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_uraian_resiko_proyek';
    }
}
