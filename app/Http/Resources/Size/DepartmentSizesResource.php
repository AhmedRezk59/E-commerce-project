<?php

namespace App\Http\Resources\Size;

use App\Models\Department;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentSizesResource extends JsonResource
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
            'parents' => Department::where('id', $this->parent)        ];
    }
}
