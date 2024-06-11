<?php

namespace App\Imports;

ini_set('memory_limit', '256M');

use App\Models\Kabupaten;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Perusahaan;
use App\Models\ProfilePengusaha;
use App\Models\UraianResikoProyek;
use App\Models\UraianSkalaUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class KbliPerusahaanImport implements ToModel, WithHeadingRow, WithUpserts
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    protected $perusahaans;
    protected $kblis;
    protected $uraian_resiko_proyeks;
    protected $uraian_skala_usahas;
    protected $kecamatans;
    protected $kelurahans;
    protected $profile_pengusahas;

    public function __construct()
    {
        $this->perusahaans = Perusahaan::all();
        $this->kblis = Kbli::all();
        $this->uraian_resiko_proyeks = UraianResikoProyek::all();
        $this->uraian_skala_usahas = UraianSkalaUsaha::all();
        $this->kecamatans = Kecamatan::all();
        $this->kelurahans = Kelurahan::all();
        $this->profile_pengusahas = ProfilePengusaha::all();
        set_time_limit(1000);
        ini_set('memory_limit', '512M');
    }

    public function model(array $row)
    {
        $perusahaan = $this->perusahaans->where('nama_perusahaan', $row['nama_perusahaan'])->first();
        $kbli = $this->kblis->where('kbli', $row['kbli'])->first();
        $uraian_resiko_proyek = $this->uraian_resiko_proyeks->where('nama_uraian_resiko_proyek', $row['uraian_risiko_proyek'])->first();
        $uraian_skala_usaha = $this->uraian_skala_usahas->where('nama_uraian_skala_usaha', $row['uraian_skala_usaha'])->first();
        $kecamatan = $this->kecamatans->where('nama_kecamatan', $row['kecamatan_usaha'])->first();
        $kelurahan = $this->kelurahans->where('nama_kelurahan', $row['kelurahan_usaha'])->first();
        $profile_pengusaha = $this->profile_pengusahas->where('nama_pengusaha', $row['nama_user'])->first();

        return new KbliPerusahaan([
            'perusahaan_id' => $perusahaan->id ?? null,
            'npwp' => $row['npwp_perusahaan'],
            'kode_proyek' => $row['id_proyek'],
            'kbli_id' => $kbli->id ?? null,
            'uraian_resiko_proyek_id' => $uraian_resiko_proyek->id ?? null,
            'uraian_skala_usaha_id' => $uraian_skala_usaha->id ?? null,
            'alamat' => $row['alamat_usaha'],
            'kecamatan_id' => $kecamatan->id ?? null,
            'kelurahan_id' => $kelurahan->id ?? null,
            'longtitude' => $row['longitude'],
            'latitude' => $row['latitude'],
            'profile_pengusaha_id' => $profile_pengusaha->id ?? null,
            'mesin_peralatan' => $row['mesin_peralatan'],
            'mesin_peralatan_impor' => $row['mesin_peralatan_impor'],
            'pembelian_pematangan_tanah' => $row['pembelian_pematangan_tanah'],
            'bangunan_gedung' => $row['bangunan_gedung'],
            'modal_kerja' => $row['modal_kerja'],
            'lain_lain' => $row['lain_lain'],
            'jumlah_investasi' => $row['jumlah_investasi'],
            'tenaga_kerja' => $row['tki'],

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
        return 'kode_proyek';
    }
}
