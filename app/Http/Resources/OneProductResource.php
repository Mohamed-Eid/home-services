<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OneProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $details = $this->details;
        $total =0;
        foreach ($details as $detail) {
            $prices = [];
            foreach ($detail->subdetails as $subdetail) {
                array_push($prices , $subdetail->price); 
            }
            if($prices != [])
            {
                $total += min($prices);
            }
            
        }
        $images = ImageResource::collection($this->images);
        $all_images = [];
        foreach ($images as $image) {
            $all_images[] = $image->image;
        }
        //dd(request()->client->district->delivered_cost);
        $special_size = [];
        if($this->tafsil)
        {
            if($this->length_cost!=null || $this->length_cost!=0){
                $special_size[] = [
                    'id' => 1,
                    'cost'=>$this->length_cost
                    ];
            }
            if($this->width_cost!=null || $this->width_cost!=0){
                $special_size[] = [
                    'id' => 2,
                    'cost'=>$this->width_cost
                    ];
            }
            if($this->height_cost!=null || $this->height_cost!=0){
                $special_size[] = [
                    'id' => 3,
                    'cost'=>$this->height_cost
                    ];
            }
            if($this->depth_cost!=null || $this->depth_cost!=0){
                $special_size[] = [
                    'id' => 4,
                    'cost'=>$this->depth_cost
                    ];
            }
        }

        $data = [
            'id'          => $this->id,
            'name'        => $this->name,
            'image_path'  => $this->image_path,
            'images'      => $all_images,
            'description' => $this->description,
            'sizes'       => SizeResource::collection($this->sizes),
            'details'     => DetailResource::collection($this->details->sortBy('sort')),
            'special_size' => $special_size,
        ];
        return $data;

    }
}
