<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class CarpetCleaningService extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'area', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
