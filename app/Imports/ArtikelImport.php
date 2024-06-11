<?php

namespace App\Imports;

ini_set('memory_limit', '256M');

use App\Models\KategoriArtikel;
use App\Models\KbliPerusahaan;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ArtikelImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $kategoris;
    protected $users;

    public function __construct()
    {
        $this->kategoris = KategoriArtikel::all();
        $this->users = User::all();
        set_time_limit(1000);
        ini_set('memory_limit', '512M');
    }

    public function model(array $row)
    {
        $kategoris = $this->kategoris->where('kategori', $row['kategori'])->first();
        $users = $this->users->where('name', $row['name'])->first();

        return new KbliPerusahaan([

            'judul' => $row['judul'],
            'slug' => $row['slug'],
            'deskripsi' => $row['deskripsi'],
            'thumbnail' => $row['thumbnail'],
            'kategori_id' => $kategoris->id ?? null,
            'penerbit_id' => $users->id ?? null,

        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'judul';
    }
}
