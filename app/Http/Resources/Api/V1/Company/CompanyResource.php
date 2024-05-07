<?php

namespace App\Http\Resources\Api\V1\Company;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\Cms\User\UserThinResource;

class CompanyResource extends JsonResource
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
            'address'                => $this->address,
            'phone'                => $this->phone,
            'email'                => $this->email,
            'logo'                => $this->logo,
            'website'                => $this->website,
            'createdByUser'       => new UserThinResource($this->createdByUser),
            'updatedByUser'       => new UserThinResource($this->updatedByUser),
            'createdAt'           => $this->created_at->format('Y-m-d g:i A'),
            'updatedAt'           => $this->updated_at->format('Y-m-d g:i A'),
        ];
    }

}
