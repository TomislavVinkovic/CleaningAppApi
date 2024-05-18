<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Service extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;

    protected $fillable = [
        'type', 'duration_days'
    ];

    public function sofaCleaningService()
    {
        return $this->hasOne(SofaCleaningService::class);
    }

    public function carpetCleaningService()
    {
        return $this->hasOne(CarpetCleaningService::class);
    }

    public function carCleaningService()
    {
        return $this->hasOne(CarCleaningService::class);
    }

    public function kercherService()
    {
        return $this->hasOne(KercherService::class);
    }
}