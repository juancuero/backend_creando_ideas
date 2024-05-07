<?php

namespace App\Http\Resources\Api\V1\Cms\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'                  => $this->id,
            'name'                => $this->name,
            'createdAt'           => $this->created_at->format('Y-m-d g:i A'),
            'updatedAt'           => $this->updated_at->format('Y-m-d g:i A'),
        ];
    }
}
