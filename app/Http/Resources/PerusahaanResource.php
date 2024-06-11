<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PerusahaanResource extends JsonResource
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
            'nama_perusahaan' => $this->nama_perusahaan,
            'nib' => $this->nib,
            'penanaman_modal_id' => $this->penanaman_modal_id,
            'penanaman_modal' => $this->status_pmdn,
            'uraian_jenis_perusahaan_id' => $this->uraian_jenis_perusahaan_id,
            'uraian_jenis_perusahaan' => $this->nama_uraian_jenis_perusahaan,
            'alamat' => $this->alamat,
            'kabupaten_id' => $this->kabupaten_id,
            'kabupaten' => $this->nama_kabupaten,
            'email' => $this->email,
            'no_telp' => $this->no_telp,
        ];
    }
}
