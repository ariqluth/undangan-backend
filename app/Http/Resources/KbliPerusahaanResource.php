<?php

namespace App\Http\Resources;

use App\Models\Gambar;
use App\Models\Kabupaten;
use App\Models\Kbli;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\PenanamanModal;
use App\Models\Perusahaan;
use App\Models\ProfilePengusaha;
use App\Models\UraianJenisPerusahaan;
use App\Models\UraianResikoProyek;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Storage;
use App\Models\UraianSkalaUsaha;
use Illuminate\Http\Resources\Json\JsonResource;

class KbliPerusahaanResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $perusahaan = Perusahaan::find($this->perusahaan_id);
        $pmdn = optional($perusahaan)->penanaman_modal_id ? PenanamanModal::find($perusahaan->penanaman_modal_id) : null;
        $ujp = optional($perusahaan)->uraian_jenis_perusahaan_id ? UraianJenisPerusahaan::find($perusahaan->uraian_jenis_perusahaan_id) : null;
        $kabupaten = optional($perusahaan)->kabupaten_id ? Kabupaten::find($perusahaan->kabupaten_id) : null;
        $kbli = Kbli::find($this->kbli_id);
        $urp = UraianResikoProyek::find($this->uraian_resiko_proyek_id);
        $usu = UraianSkalaUsaha::find($this->uraian_skala_usaha_id);
        $kecamatan = Kecamatan::find($this->kecamatan_id);
        $kelurahan = Kelurahan::find($this->kelurahan_id);
        $profile_pengusaha = ProfilePengusaha::find($this->profile_pengusaha_id);

        $gambar = Gambar::find($this->gambar_id);
        $gambarSource = $gambar ? $gambar : $this->gambar;
        if ($gambarSource instanceof Collection) {
            $gambarData = $gambarSource->map(function ($gambar) {
                return [
                    'path' => $gambar->path,
                    'star' => $gambar->star,
                ];
            });
        } else {
            $gambarData = $gambarSource ? [
                'path' => Storage::url($gambarSource->path),
                'star' => $gambarSource->star,
            ] : null;
        }





        return [
            'id' => $this->id,
            'perusahaan_id' => $this->perusahaan_id,

            //perusahaan
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

            'npwp' => $this->npwp,
            'kode_proyek' => $this->kode_proyek,
            'kbli_id' => $this->kbli_id,

            //kbli
            'kbli' => $kbli ? $kbli->kbli : null,
            'judul_kbli' => $kbli ? $kbli->judul_kbli : null,
            'sektor' => $kbli ? $kbli->sektor : null,
            //batas_kbli

            'uraian_resiko_proyek_id' => $this->uraian_resiko_proyek_id,

            //uraian_resiko_proyek
            'nama_uraian_resiko_proyek' => $urp ? $urp->nama_uraian_resiko_proyek : null,
            //batas_uraian_resiko_proyek

            'uraian_skala_usaha_id' => $this->uraian_skala_usaha_id,

            //uraian_sakla_usaha
            'nama_uraian_skala_usaha' => $usu ? $usu->nama_uraian_skala_usaha : null,
            //batas_uraian_sakla_usaha

            'alamat' => $this->alamat,

            'kecamatan_id' => $this->kecamatan_id,

            //kecamatan
            'nama_kecamatan' => $kecamatan ? $kecamatan->nama_kecamatan : null,
            //batas_kecamatan

            'kelurahan_id' => $this->kelurahan_id,

            //kelurahan
            'nama_kelurahan' => $kelurahan ? $kelurahan->nama_kelurahan : null,
            //batas_kelurahan

            'longtitude' => $this->longtitude,
            'latitude' => $this->latitude,
            'profile_pengusaha_id' => $this->profile_pengusaha_id,

            //profile_pengusaha
            'nomor_identitas_user' => $profile_pengusaha ? $profile_pengusaha->nomor_identitas_user : null,
            'nama_pengusaha' => $profile_pengusaha ? $profile_pengusaha->nama_pengusaha : null,
            'no_telp_pengusaha' => $profile_pengusaha ? $profile_pengusaha->no_telp : null,
            'email_pengusaha' => $profile_pengusaha ? $profile_pengusaha->email : null,
            //batas_profile_pengusaha

            'mesin_peralatan'  => $this->mesin_peralatan,
            'mesin_peralatan_impor'  => $this->mesin_peralatan_impor,
            'pembelian_pematangan_tanah' => $this->pembelian_pematangan_tanah,
            'bangunan_gedung'  => $this->bangunan_gedung,
            'lain_lain'  => $this->lain_lain,
            'modal_kerja'  => $this->modal_kerja,
            'jumlah_investasi'  => $this->jumlah_investasi,
            'tenaga_kerja'  => $this->tenaga_kerja,
            'gambar' => $gambarData,
        ];
    }
}
