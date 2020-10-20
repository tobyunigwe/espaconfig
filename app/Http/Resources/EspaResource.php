<?php

namespace App\Http\Resources;

use App\Models\Config;
use Illuminate\Http\Resources\Json\JsonResource;

class EspaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id'=> $this->id,
            'config_id'=> $this->config_id,
            'enabled'=> $this->enabled,
            'configs'=> ConfigResource::collection($this->whenLoaded('configs'))
        ];
    }
}
