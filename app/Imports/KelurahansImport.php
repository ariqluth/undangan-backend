<?php

namespace App\Imports;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelurahansImport implements ToModel, WithHeadingRow
{
    protected $kabupatens;
    protected $kecamatans;
    protected $kelurahans;

    public function __construct()
    {
        $this->kabupatens = Kabupaten::select('id', 'nama_kabupaten')->get();
        $this->kecamatans = Kecamatan::select('id', 'nama_kecamatan')->get();
        $this->kelurahans = Kelurahan::all();
    }

    public function model(array $row)
    {
        $validator = Validator::make($row, [
            'nama_kelurahan' => [
                'required',
                Rule::unique('kelurahan')->where(function ($query) use ($row) {
                    return $query->where('kecamatan_id', $this->getKecamatanId($row['nama_kecamatan']));
                }),
            ],
        ]);

        if ($validator->passes()) {
            $existingRecord = Kelurahan::where([
                'nama_kelurahan' => $row['nama_kelurahan'],
                'kabupaten_id' => $this->getKabupatenId($row['nama_kabupaten']),
                'kecamatan_id' => $this->getkecamatanId($row['nama_kecamatan']),
            ])->first();
            if (!$existingRecord) {
                Kelurahan::create([
                    'nama_kelurahan' => $row['nama_kelurahan'],
                    'kabupaten_id' => $this->getKabupatenId($row['nama_kabupaten']),
                    'kecamatan_id' => $this->getkecamatanId($row['nama_kecamatan']),
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

    private function getKecamatanId(string $nama_kecamatan): ?int
    {
        $kecamatan = $this->kecamatans->where('nama_kecamatan', $nama_kecamatan)->first();
        return $kecamatan ? $kecamatan->id : null;
    }
}
