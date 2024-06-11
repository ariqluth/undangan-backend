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

class KbliSearchResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $kbli = Kbli::find($this->kbli_id);
        return [
            'id' => $this->id,
            // 'kbli_id' => $this->kbli_id,
            //kbli
            'kbli' => $this->kbli,
            'judul_kbli' => $this->judul_kbli,
            'sektor' => $this->sektor,
            //batas_kbli

        ];
    }
}
