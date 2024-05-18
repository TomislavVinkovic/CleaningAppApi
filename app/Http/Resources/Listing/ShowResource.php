<?php

namespace App\Http\Resources\Listing;

use App\Http\Resources\Service\DetailsResource as ServiceDetailsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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

            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'oib' => $this->oib,

            'address' => $this->address,
            'city' => $this->city,
            'postal_code' => $this->postal_code,

            'type' => $this->type,

            'service' => new ServiceDetailsResource($this->whenLoaded('service'))
        ];
    }
}
