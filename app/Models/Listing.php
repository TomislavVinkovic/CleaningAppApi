<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'oib',
        'address', 'city', 'postal_code',
        'type', 'service_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
