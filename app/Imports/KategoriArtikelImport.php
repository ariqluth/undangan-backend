<?php

namespace App\Imports;

use App\Models\KategoriArtikel;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KategoriArtikelImport implements ToModel, WithHeadingRow, WithUpserts
{

    public function __construct()
    {
        set_time_limit(120);
        ini_set('memory_limit', '512M');
    }
    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
    public function model(array $row)
    {
        return new KategoriArtikel([
            'nama_kategori' => $row['nama_kategori'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nama_kategori';
    }
}
