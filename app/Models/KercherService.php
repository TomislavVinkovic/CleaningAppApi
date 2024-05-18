<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class KercherService extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'psi', 'chemicals_description', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
