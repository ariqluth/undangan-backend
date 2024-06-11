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
use App\Models\UraianSkalaUsaha;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class PopupResource extends JsonResource
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
        // $pmdn = PenanamanModal::find($perusahaan->penanaman_modal_id);
        // $ujp = UraianJenisPerusahaan::find($perusahaan->uraian_jenis_perusahaan_id);
        // $kabupaten = Kabupaten::find($perusahaan->kabupaten_id);
        $kbli = Kbli::find($this->kbli_id);
        $urp = UraianResikoProyek::find($this->uraian_resiko_proyek_id);
        $usu = UraianSkalaUsaha::find($this->uraian_skala_usaha_id);
        // $kecamatan = Kecamatan::find($this->kecamatan_id);
        // $kelurahan = Kelurahan::find($this->kelurahan_id);
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
            'penanaman_modal_id' => $perusahaan ? $perusahaan->penanaman_modal_id : null,
            // 'status_pmdn' => $pmdn ? $pmdn->status_pmdn : null,
            // 'uraian_jenis_perusahaan_id' => $perusahaan ? $perusahaan->uraian_jenis_perusahaan_id : null,
            // 'nama_uraian_jenis_perusahaan' => $ujp ? $ujp->nama_uraian_jenis_perusahaan : null,
            'alamat' => $perusahaan ? $perusahaan->alamat : null,
            // 'kabupaten_id' => $perusahaan ? $perusahaan->kabupaten_id : null,
            // 'nama_kabupaten' => $kabupaten ? $kabupaten->nama_kabupaten : null,
            //batas_perusahaan

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

            // 'kecamatan_id' => $this->kecamatan_id,

            //kecamatan
            // 'nama_kecamatan' => $kecamatan ? $kecamatan->nama_kecamatan : null,
            //batas_kecamatan

            // 'kelurahan_id' => $this->kelurahan_id,

            //kelurahan
            // 'nama_kelurahan' => $kelurahan ? $kelurahan->nama_kelurahan : null,
            //batas_kelurahan

            'longtitude' => $this->longtitude,
            'latitude' => $this->latitude,
            'profile_pengusaha_id' => $this->profile_pengusaha_id,

            //profile_pengusaha
            'nama_pengusaha' => $profile_pengusaha ? $profile_pengusaha->nama_pengusaha : null,
            //batas_profile_pengusaha

            'gambar' => $gambarData,
        ];
    }
}
