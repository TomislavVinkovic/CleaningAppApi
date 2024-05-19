<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CarpetCleaningService\DetailsResource as CarpetDetailsResource;
use App\Http\Resources\CarCleaningService\DetailsResource as CarDetailsResource;
use App\Http\Resources\SofaCleaningService\DetailsResource as SofaDetailsResource;
use App\Http\Resources\KercherService\DetailsResource as KercherDetailsResource;


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
            'type' => $this->type,
            'duration_days' => $this->duration_days,

            'carpet_cleaning_service' => new CarpetDetailsResource($this->whenLoaded('carpetCleaningService')),
            'car_cleaning_service' => new CarDetailsResource($this->whenLoaded('carCleaningService')),
            'sofa_cleaning_service' => new SofaDetailsResource($this->whenLoaded('sofaCleaningService')),
            'kercher_service' => new KercherDetailsResource($this->whenLoaded('kercherService')),
        ];
    }
}
