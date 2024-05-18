<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name', 'oib', 'address', 'city', 'postal_code', 'user_id', 'description'
    ];

    // relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
