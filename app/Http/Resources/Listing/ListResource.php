<?php

namespace App\Http\Resources\Listing;

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

            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            
            'email' => $this->email,
            'type' => $this->type,
        ];
    }
}
