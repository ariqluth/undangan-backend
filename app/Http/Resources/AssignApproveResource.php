<?php

namespace App\Http\Resources;

use App\Models\Gambar;
use App\Models\GambarKbliPerusahaan;
use App\Models\Kabupaten;
use App\Models\Kbli;
use App\Models\KbliPerusahaan;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PenanamanModal;
use App\Models\KbliPerusahaanGambarJoin;
use App\Models\Perusahaan;
use App\Models\ProfilePengusaha;
use App\Models\UraianJenisPerusahaan;
use App\Models\UraianResikoProyek;
use App\Models\UraianSkalaUsaha;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignApproveResource extends JsonResource
{
    public function toArray($request)
    {
        // dd($this->kbli_perusahaan_id);
        $kbli_perusahaan = KbliPerusahaan::find($this->kbli_perusahaan_id);
        $perusahaan = Perusahaan::find($kbli_perusahaan->perusahaan_id);
        $pmdn = $perusahaan ? PenanamanModal::find($perusahaan->penanaman_modal_id) : null;
        $ujp = $perusahaan ? UraianJenisPerusahaan::find($perusahaan->uraian_jenis_perusahaan_id) : null;
        $kabupaten = $perusahaan ? Kabupaten::find($perusahaan->kabupaten_id) : null;
        $kbli = Kbli::find($kbli_perusahaan->kbli_id);
        $urp = UraianResikoProyek::find($kbli_perusahaan->uraian_resiko_proyek_id);
        $usu = UraianSkalaUsaha::find($kbli_perusahaan->uraian_skala_usaha_id);
        $kecamatan = Kecamatan::find($kbli_perusahaan->kecamatan_id);
        $kelurahan = Kelurahan::find($kbli_perusahaan->kelurahan_id);
        $profile_pengusaha = ProfilePengusaha::find($kbli_perusahaan->profile_pengusaha_id);
        $user = User::find($this->assign_to);
        $gambar_kbli_perusahaan = KbliPerusahaanGambarJoin::where('kbli_perusahaan_id', $this->kbli_perusahaan_id)
            // ->leftJoin('kbli_perusahaan', 'kbli_perusahaan_id.kbli_perusahaan_id', '=', 'kbli_perusahaan.id')
            ->leftJoin('gambar', 'gambar_kbli_perusahaan.gambar_id', '=', 'gambar.id')
            ->first(['gambar.path', 'gambar.nama_gambar']);

        return [
            'id' => $this->id,
            'kbli_perusahaan_id' => $this->kbli_perusahaan_id,
            //perusahaan
            'perusahaan_id' => $perusahaan ? $kbli_perusahaan->perusahaan_id : null,
            'nama_perusahaan' => $perusahaan ? $perusahaan->nama_perusahaan : null,
            'nib' => $perusahaan ? $perusahaan->nib : null,
            'penanaman_modal_id' => $perusahaan ? $perusahaan->penanaman_modal_id : null,
            'status_pmdn' => $pmdn ? $pmdn->status_pmdn : null,
            'uraian_jenis_perusahaan_id' => $perusahaan ? $perusahaan->uraian_jenis_perusahaan_id : null,
            'nama_uraian_jenis_perusahaan' => $ujp ? $ujp->nama_uraian_jenis_perusahaan : null,
            'alamat' => $perusahaan ? $perusahaan->alamat : null,
            'kabupaten_id' => $perusahaan ? $perusahaan->kabupaten_id : null,
            'nama_kabupaten' => $kabupaten ? $kabupaten->nama_kabupaten : null,
            'email' => $perusahaan ? $perusahaan->email : null,
            'no_telp' => $perusahaan ? $perusahaan->no_telp : null,
            //batas_perusahaan

            'npwp' => $kbli_perusahaan->npwp,
            'kode_proyek' => $kbli_perusahaan->kode_proyek,

            //kbli
            'kbli_id' => $kbli_perusahaan->kbli_id,
            'kbli' => $kbli ? $kbli->kbli : null,
            'judul_kbli' => $kbli ? $kbli->judul_kbli : null,
            'sektor' => $kbli ? $kbli->sektor : null,
            //batas_kbli

            //uraian_resiko_proyek
            'uraian_resiko_proyek_id' => $kbli_perusahaan->uraian_resiko_proyek_id,
            'nama_uraian_resiko_proyek' => $urp ? $urp->nama_uraian_resiko_proyek : null,
            //batas_uraian_resiko_proyek

            //uraian_sakla_usaha
            'uraian_skala_usaha_id' => $kbli_perusahaan->uraian_skala_usaha_id,
            'nama_uraian_skala_usaha' => $usu ? $usu->nama_uraian_skala_usaha : null,
            //batas_uraian_sakla_usaha

            'alamat' => $kbli_perusahaan->alamat,

            //kecamatan
            'kecamatan_id' => $kbli_perusahaan->kecamatan_id,
            'nama_kecamatan' => $kecamatan ? $kecamatan->nama_kecamatan : null,
            //batas_kecamatan

            //kelurahan
            'kelurahan_id' => $kbli_perusahaan->kelurahan_id,
            'nama_kelurahan' => $kelurahan ? $kelurahan->nama_kelurahan : null,
            //batas_kelurahan

            'longtitude' => $kbli_perusahaan->longtitude,
            'latitude' => $kbli_perusahaan->latitude,
            'profile_pengusaha_id' => $kbli_perusahaan->profile_pengusaha_id,

            //profile_pengusaha
            'nomor_identitas_user' => $profile_pengusaha ? $profile_pengusaha->nomor_identitas_user : null,
            'nama_pengusaha' => $profile_pengusaha ? $profile_pengusaha->nama_pengusaha : null,
            'no_telp_pengusaha' => $profile_pengusaha ? $profile_pengusaha->no_telp : null,
            'email_pengusaha' => $profile_pengusaha ? $profile_pengusaha->email : null,
            //batas_profile_pengusaha

            'mesin_peralatan'  => $kbli_perusahaan->mesin_peralatan,
            'mesin_peralatan_impor'  => $kbli_perusahaan->mesin_peralatan_impor,
            'pembelian_pematangan_tanah' => $kbli_perusahaan->pembelian_pematangan_tanah,
            'bangunan_gedung'  => $kbli_perusahaan->bangunan_gedung,
            'lain_lain'  => $kbli_perusahaan->lain_lain,
            'modal_kerja'  => $kbli_perusahaan->modal_kerja,
            'jumlah_investasi'  => $kbli_perusahaan->jumlah_investasi,
            'tenaga_kerja'  => $kbli_perusahaan->tenaga_kerja,

            'gambar' => $gambar_kbli_perusahaan ? $gambar_kbli_perusahaan->path : null,

            'assign_to' => $this->assign_to,
            'assign_to_name' => $user->name,

            'perubahan' => $this->perubahan,
            'status' => $this->status
        ];
    }
}
