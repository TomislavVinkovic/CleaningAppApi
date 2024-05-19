<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $fillable = [
        'price', 'status', 'listing_id', 'user_id'
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
    public function user()
    {
        return $this->belongsTo(Listing::class);
    }
}
