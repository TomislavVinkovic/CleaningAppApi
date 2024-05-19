<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Listing extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'oib',
        'address', 'city', 'postal_code',
        'type', 'service_id'
    ];

    // Scopes
    public function scopeWhereNoOffersFromCurrentUser(Builder $query)
    {
        return $query->whereDoesntHave('offers', function ($q) {
            $q->where('user_id', auth()->id());
        });
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function job() {
        return $this->hasOne(Job::class);
    }

    public function offers() {
        return $this->hasMany(Offer::class);
    }
}
