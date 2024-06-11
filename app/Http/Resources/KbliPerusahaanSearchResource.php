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

class KbliPerusahaanSearchResource extends JsonResource
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
        $kbli = Kbli::find($this->kbli_id);
      



        return [
            'id' => $this->id,
            'perusahaan_id' => $this->perusahaan_id,

            //perusahaan
            'nama_perusahaan' => $perusahaan ? $perusahaan->nama_perusahaan : null,
            'nib' => $perusahaan ? $perusahaan->nib : null,
            'penanaman_modal_id' => $perusahaan ? $perusahaan->penanaman_modal_id : null,
        
            'email' => $perusahaan ? $perusahaan->email : null,
            'no_telp' => $perusahaan ? $perusahaan->no_telp : null,
            //batas_perusahaan

          
            'kbli_id' => $this->kbli_id,

            //kbli
            'kbli' => $kbli ? $kbli->kbli : null,
            'judul_kbli' => $kbli ? $kbli->judul_kbli : null,
            'sektor' => $kbli ? $kbli->sektor : null,
            
        ];
    }
}
