<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConfigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $espa = $this->whenloaded('espa');
        return [
            'id'=> $this->id,
            'version'=> $this->version,
            'espa'=> new EspaResource($espa)
        ];
    }
}
