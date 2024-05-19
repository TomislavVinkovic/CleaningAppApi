<?php

namespace App\Http\Resources\KercherService;

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
            'psi' => $this->psi,
            'chemicals_description' => $this->chemicals_description
        ];
    }
}
