<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];
    protected $appends = ['src'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    // getRealSrcAttribute -> real_src
    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
