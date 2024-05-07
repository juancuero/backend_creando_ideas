<?php

namespace App\Http\Resources\Api\V1\Cms\User;

use App\Http\Resources\Api\V1\Cms\Role\RoleThinResource;
use App\Http\Resources\Api\V1\Position\PositionThinResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'username'            => $this->username,
            'email'               => $this->email,
            'firstName'           => $this->first_name,
            'lastName'            => $this->last_name,
            'role'                => new RoleThinResource($this->role),
            'position'            => new PositionThinResource($this->position),
            'status'              => $this->status,
            'createdAt'           => $this->created_at->format('Y-m-d g:i A'),
            'updatedAt'           => $this->updated_at->format('Y-m-d g:i A'),
        ];
    }
}
