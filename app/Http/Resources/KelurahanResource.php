<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KelurahanResource extends JsonResource
{
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'kabupaten_id' => $this->kabupaten_id,
            'kecamatan_id' => $this->kecamatan_id,
            'nama_kelurahan' => $this->nama_kelurahan,
            'status' => $this->status,
        ];
    }
}
