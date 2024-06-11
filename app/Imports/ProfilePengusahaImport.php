<?php

namespace App\Imports;

use App\Models\ProfilePengusaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProfilePengusahaImport implements ToModel, WithHeadingRow, WithUpserts
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
        return new ProfilePengusaha([
            'nomor_identitas_user' => $row['nomor_identitas_user'],
            'nama_pengusaha' => $row['nama_user'],
            'no_telp' => $row['nomor_telp'],
            'email' => $row['email'],
        ]);
    }

    public function uniqueBy()
    {
        return 'nomor_identitas_user';
    }
}
