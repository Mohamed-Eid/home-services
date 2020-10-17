<?php

namespace App\Http\Resources;

use App\Detail;
use App\Subdetail;
use App\Tax;
use App\Size;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingCartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $product = [
            'name'       => $this->product->name,
            'image_path' => $this->product->image_path,
        ];
        $data = [];
        //dd($this->details);
        foreach ($this->details as $detail) {
            $detail_ = Detail::find($detail['detail_id']);
            $subdetail = Subdetail::find($detail['subdetail_id']);
            $data[] = [ 
                "key" => $detail_->name,
                "value" => $subdetail->name 
            ];
        }

        return [
            'id'            => $this->id,
            //'product'       => $product,
            'product'       => new ProductResource($this->product),
            'cart_data'     => $data ,
            'quantity'      => $this->quantity,
            'price_type'    => $this->price_type,
            'price'         => $this->price,
        ];
    }
}
