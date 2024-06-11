<?php

namespace App\Imports;

use App\Models\Kbli;
use App\Models\Perusahaan;
use App\Models\TotalPembiayaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TotalPembiayaanImport implements ToModel, WithHeadingRow
{
    protected $perusahaans;
    protected $kblis;
    protected $total_pembayarans;

    public function __construct()
    {
        $this->perusahaans = Perusahaan::select('id', 'nama_perusahaan')->get();
        $this->kblis = Kbli::select('id', 'kbli')->get();
        $this->total_pembayarans = TotalPembiayaan::all();
    }

    public function model(array $row)
    {

        $validator = Validator::make($row, [
            'kbli_id' => [
                'required',
                Rule::unique('kbli_perusahaan')->where(function ($query) use ($row) {
                    return $query->where('nama_perusahaan_id', $this->getKbliId($row['kbli_id']));
                }),
            ],
        ]);

        if ($validator->passes()) {
            $existingRecord = TotalPembiayaan::where([
                'mesin_peralatan' => $row['mesin_peralatan'],
                'mesin_peralatan_impor' => $row['mesin_peralatan_impor'],
                'pembelian_pematangan_tanah' => $row['pembelian_pematangan_tanah'],
                'bangunan_gedung' => $row['bangunan_gedung'],
                'modal_kerja' => $row['modal_kerja'],
                'lain_lain' => $row['lain_lain'],
                'jumlah_investasi' => $row['jumlah_investasi'],
                'tenaga_kerja' => $row['tenaga_kerja'],
                'perusahaan_id' => $this->getPerusahaanId($row['perusahaan_id']),
                'kbli_id' => $this->getKbliId($row['kbli_id']),
            ])->first();
            if (!$existingRecord) {
                TotalPembiayaan::create([
                    'mesin_peralatan' => $row['mesin_peralatan'],
                    'mesin_peralatan_impor' => $row['mesin_peralatan_impor'],
                    'pembelian_pematangan_tanah' => $row['pembelian_pematangan_tanah'],
                    'bangunan_gedung' => $row['bangunan_gedung'],
                    'modal_kerja' => $row['modal_kerja'],
                    'lain_lain' => $row['lain_lain'],
                    'jumlah_investasi' => $row['jumlah_investasi'],
                    'tenaga_kerja' => $row['tenaga_kerja'],
                    'perusahaan_id' => $this->getPerusahaanId($row['perusahaan_id']),
                    'kbli_id' => $this->getKbliId($row['kbli_id']),
                ]);
            }
        } else {
            //
        }

        return null;
    }


    private function getKbliId(string $kbli_id): ?int
    {
        $kblis = $this->kblis->where('kbli_id', $kbli_id)->first();
        return $kblis ? $kblis->id : null;
    }

    private function getPerusahaanId(string $nama_perusahaan_id): ?int
    {
        $perusahaans = $this->perusahaans->where('perusahaan_id', $nama_perusahaan_id)->first();
        return $perusahaans ? $perusahaans->id : null;
    }
}
