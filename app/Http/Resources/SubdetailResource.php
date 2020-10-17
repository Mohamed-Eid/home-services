<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubdetailResource extends JsonResource
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
            'id' => $this->id,
            'index' => $this->sort,
            'name' => $this->name,
            'type' => $this->detail->name,
            'price' => $this->price,
            'price_by_kilo' => $this->price_by_kilo,
            'price_by_piece' => $this->price_by_piece,

        ];
    }
}
