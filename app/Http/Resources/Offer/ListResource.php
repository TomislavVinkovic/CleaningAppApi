<?php

namespace App\Http\Resources\Offer;

use App\Http\Resources\Listing\ShowResource;
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
            'listing' => new ShowResource($this->whenLoaded('listing')),
            'price' => $this->price,
            'status' => $this->status
        ];
    }
}
