<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $images = ImageResource::collection($this->images);
        $all_images = [];
        foreach ($images as $image) {
            $all_images[] = $image->image;
        }
        
        $videos = VideoResource::collection($this->videos);
        $all_videos = [];
        foreach ($videos as $video) {
            $all_videos[] = $video->video;
        }
        
        
        return [
            'id' => $this->id,
            'name' => $this->translate(app()->getLocale())->name,
            'sort' => $this->sort,
            'image_path'  => $this->image == 'default.png' ? $all_images[0] : $this->image_path,
            'images'      => $all_images,
            'videos'      => $all_videos,
            'rate'       => $this->rate,
            'rates'      => RateResource::collection($this->rates),
            'vendor'     => new VendorResource($this->vendor),
            'description' => $this->description ?? '',
            'price'      => $this->lowest_price(),
            'prices'     => $this->prices(),
            'discount'   => $this->discount,
            'price_after_discount' => ($this->lowest_price() - ($this->lowest_price()*$this->discount/100)),
            'prices_after_disount' => $this->prices_after_discount(),
            'details'     => DetailResource::collection($this->details->sortBy('sort')),
        ];
    }
}
