<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilePengusahaResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nomor_identitas_user' => $this->nomor_identitas_user,
            'nama_pengusaha' => $this->nama_pengusaha,
            'no_telp' => $this->no_telp,
            'email' => $this->email,
        ];
    }
}
