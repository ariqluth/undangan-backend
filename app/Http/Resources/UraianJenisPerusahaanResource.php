<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UraianJenisPerusahaanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nama_uraian_jenis_perusahaan' => $this->nama_uraian_jenis_perusahaan,
        ];
    }
}
