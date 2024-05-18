<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Company\DetailsResource as CompanyDetailsResource;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'imageUrl' => $this->imageUrl,

            'roles' => $this->getRoleNames(),
            'company' => new CompanyDetailsResource($this->whenLoaded('company'))
        ];
    }
}
