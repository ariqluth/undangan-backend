<?php

namespace App\Exports;

use App\Models\KbliPerusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class KbliPerusahaanExport implements FromCollection,  WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KbliPerusahaan::Select(
            'kbli_perusahaan.id',
            'kbli_perusahaan.kode_proyek',
            'perusahaan.nib as nib',
            'kbli_perusahaan.npwp',
            'perusahaan.nama_perusahaan as nama_perusahaan',
            'pm.status_pmdn as status_pmdn',
            'ujp.nama_uraian_jenis_perusahaan as nama_uraian_jenis_perusahaan',
            'uraian_resiko_proyek.nama_uraian_resiko_proyek as nama_uraian_resiko_proyek',
            'uraian_skala_usaha.nama_uraian_skala_usaha as nama_uraian_skala_usaha',
            'perusahaan.alamat as alamat',
            // 'kab.nama_kabupaten',
            'kecamatan.nama_kecamatan as nama_kecamatan ',
            'kelurahan.nama_kelurahan as nama_kelurahan ',
            'kbli_perusahaan.longtitude',
            'kbli_perusahaan.latitude',
            'kbli.kbli as kbli',
            'kbli.judul_kbli as judul_kbli',
            'kbli.sektor as sektor',
            'profile_pengusaha.nama_pengusaha',
            'profile_pengusaha.nomor_identitas_user',
            'profile_pengusaha.email',
            'profile_pengusaha.no_telp',
            'kbli_perusahaan.mesin_peralatan',
            'kbli_perusahaan.mesin_peralatan_impor',
            'kbli_perusahaan.pembelian_pematangan_tanah',
            'kbli_perusahaan.bangunan_gedung',
            'kbli_perusahaan.modal_kerja',
            'kbli_perusahaan.lain_lain',
            'kbli_perusahaan.jumlah_investasi',
            'kbli_perusahaan.tenaga_kerja',
        )
            ->leftJoin('perusahaan', 'kbli_perusahaan.perusahaan_id', '=', 'perusahaan.id')
            ->leftJoin('profile_pengusaha', 'kbli_perusahaan.profile_pengusaha_id', '=', 'profile_pengusaha.id')
            ->leftJoin('kbli', 'kbli_perusahaan.kbli_id', '=', 'kbli.id')
            ->leftJoin('kabupaten as kab', function ($join) {
                $join->on('perusahaan.kabupaten_id', '=', 'kab.id');
            })
            ->leftJoin('uraian_jenis_perusahaan as ujp', function ($join) {
                $join->on('perusahaan.uraian_jenis_perusahaan_id', '=', 'ujp.id');
            })
            ->leftJoin('penanaman_modal as pm', function ($join) {
                $join->on('perusahaan.penanaman_modal_id', '=', 'pm.id');
            })
            ->leftJoin('kecamatan', 'kbli_perusahaan.kecamatan_id', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'kbli_perusahaan.kelurahan_id', '=', 'kelurahan.id')
            ->leftJoin('uraian_resiko_proyek', 'uraian_resiko_proyek_id', '=', 'uraian_resiko_proyek.id')
            ->leftJoin('uraian_skala_usaha', 'uraian_skala_usaha_id', '=', 'uraian_skala_usaha.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Id Proyek',
            'Nib',
            'Npwp Perusahaan',
            'Nama Perusahaan',
            'Uraian Status Penanaman Modal',
            'Uraian Jenis Perusahaan',
            'Uraian Resiko Proyek',
            'Uraian Skala Usaha',
            'Alamat Usaha',
            // 'Kabupaten Usaha',
            'Kecamatan Usaha',
            'kelurahan Usaha',
            'Longtitude',
            'Latitude',
            'Kbli',
            'Judul Kbli',
            'KL/Sektor Pembina',
            'Nama Pengusaha',
            'Nomor Identitas User',
            'Email',
            'No. Telp',
            'Mesin Peralatan',
            'Mesin Peralatan Impor',
            'Pembelian Pematangan Tanah',
            'Bangunan Gedung',
            'Modal Kerja',
            'Lain - Lain',
            'Jumlah Investasi',
            'Tenaga Kerja',
        ];
    }
}
