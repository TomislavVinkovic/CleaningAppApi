<?php

namespace App\Http\Resources\CarCleaningService;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Facades\Log;

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
            'car_type' => $this->car_type,
            'no_seats' => $this->no_seats,
            'service_id' => $this->service_id,
        ];
    }
}
