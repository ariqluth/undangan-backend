<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LoginResource extends JsonResource
{
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this['user']->id,
            'email' => $this['user']->email,
            'name' => $this['user']->name,
            'token' => $this->resource['token'],
            'user' => $this->resource['user'],
        ];
    }
}
