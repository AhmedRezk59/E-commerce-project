<?php

namespace App\Http\Resources\UI;

use Illuminate\Http\Resources\Json\JsonResource;

class GetProductResource extends JsonResource
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
            'encrypted_id' => encrypt($this->id),
            'title' => $this->title,
            'photo' => $this->photo,
            'files' => $this->files,
            'content' => $this->content,
            'department' => $this->department,
            'trademark' => $this->trademark->name,
            'color' => $this->color,
            'size' => $this->size,
            'size_id' => $this->size_type,
            'price' => $this->price,
            'start_at' => $this->start_at,
            'price_offer' => $this->price_offer,
            'start_offer_at' => $this->start_offer_at,
            'end_offer_at' => $this->end_offer_at,
            'weight' => $this->weight,
            'weight_id' => $this->weight_type,
            'stock' => $this->stock,
            'other_data' => $this->other_data,
        ];
    }
}
