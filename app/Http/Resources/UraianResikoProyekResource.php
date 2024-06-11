<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UraianResikoProyekResource extends JsonResource
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
            'nama_uraian_resiko_proyek' => $this->nama_uraian_resiko_proyek,
        ];
    }
}
