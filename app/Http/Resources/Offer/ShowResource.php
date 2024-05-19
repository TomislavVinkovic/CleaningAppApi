<?php

namespace App\Http\Resources\Offer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Listing\ShowResource as ListingShowResource;

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
            'listing' => new ListingShowResource($this->whenLoaded('listing')),
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}
