<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UraianSkalaUsahaResource extends JsonResource
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
            'nama_uraian_skala_usaha' => $this->nama_uraian_skala_usaha,
        ];
    }
}
