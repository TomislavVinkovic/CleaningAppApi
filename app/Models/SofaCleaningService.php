<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SofaCleaningService extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'no_seats', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
