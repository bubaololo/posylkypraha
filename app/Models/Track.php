<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Track extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'parcel_id',
        'number',
    ];
    
    public function parcel(): BelongsTo
    {
        return $this->belongsTo(Parcel::class);
    }
}
