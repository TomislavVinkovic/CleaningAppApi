<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory, HasUuids;
    public $incrementing = false;

    protected $fillable = [
        'listing_id', 'user_id', 'price', 'is_completed'
    ];

    public function listing() {
        return $this->belongsTo(Listing::class);
    }
}
