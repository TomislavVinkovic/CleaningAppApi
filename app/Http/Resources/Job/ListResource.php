<?php

namespace App\Http\Resources\Job;

use App\Http\Resources\Listing\ShowResource as ListingShowResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListResource extends JsonResource
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
            'is_completed' => $this->is_completed
        ];
    }
}
