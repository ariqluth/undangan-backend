<?php

namespace App\Imports;

use App\Models\Kbli;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KblisImport implements ToModel, WithHeadingRow, WithUpserts
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
        return new Kbli([
            'kbli' => $row['kbli'],
            'judul_kbli' => $row['judul_kbli'],
            'sektor' => $row['klsektor_pembina'],
        ]);
    }

    public function uniqueBy()
    {
        return 'judul_kbli';
    }
}
