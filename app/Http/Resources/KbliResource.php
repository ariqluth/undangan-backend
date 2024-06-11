<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KbliResource extends JsonResource
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
            'kbli' => $this->kbli,
            'judul_kbli' => $this->judul_kbli,
            'sektor' => $this->sektor,
        ];
    }
}
