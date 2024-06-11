<?php

namespace App\Imports;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KecamatansImport implements ToModel, WithHeadingRow
{
    protected $kabupatens;
    protected $kecamatans;

    public function __construct()
    {
        $this->kabupatens = Kabupaten::select('id', 'nama_kabupaten')->get();
        $this->kecamatans = Kecamatan::all();
    }

    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'nama_kecamatan' => [
                'required',
                Rule::unique('kecamatan')->where(function ($query) use ($row) {
                    return $query->where('kabupaten_id', $this->getKabupatenId($row['nama_kabupaten']));
                }),
            ],
        ]);

        if ($validator->passes()) {
            $existingRecord = Kecamatan::where([
                'nama_kecamatan' => $row['nama_kecamatan'],
                'kabupaten_id' => $this->getKabupatenId($row['nama_kabupaten']),
            ])->first();
            if (!$existingRecord) {
                Kecamatan::create([
                    'nama_kecamatan' => $row['nama_kecamatan'],
                    'kabupaten_id' => $this->getKabupatenId($row['nama_kabupaten']),
                ]);
            }
        } else {
            //
        }
        return null;
    }

    private function getKabupatenId(string $nama_kabupaten): ?int
    {
        $kabupaten = $this->kabupatens->where('nama_kabupaten', $nama_kabupaten)->first();
        return $kabupaten ? $kabupaten->id : null;
    }
}
