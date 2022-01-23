<?php

namespace App\Http\Resources\Department;

use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class DataTree extends JsonResource
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
            'text_ar' => $this->name_ar,
            'text_en' => $this->name_en,
            'description' => $this->description,
            'keyword' => $this->keyword,
            'parent' => $this->parent,
            'opened' => true,
            'children' => DataTree::collection(Department::where('parent', $this->id)->get())
        ];
    }
}
