<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'type_id'        => $this->type_id,
            'type'           => $this->type,
            'obj_id'         => $this->parent_id,
            'image'          => $this->image,
        ];
    }
}
