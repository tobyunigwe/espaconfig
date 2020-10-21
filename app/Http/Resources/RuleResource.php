<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RuleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'espa_id'=> $this->espa_id,
            'name'=> $this->name,
            'espa' => $this->whenLoaded('espa', function () {
                return EspaResource::collection($this->resource->espa);
            }),
            'match' => $this->whenLoaded('match', function () {
                return MatchResource::collection($this->resource->match);
            }),
        ];
    }
}
