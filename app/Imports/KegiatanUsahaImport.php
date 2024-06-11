<?php

namespace App\Imports;

use App\Models\KegiatanUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KegiatanUsahaImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new KegiatanUsaha([
            'nama_kegiatan_usaha' => $row['nama_kegiatan_usaha'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_kegiatan_usaha';
    }
}
