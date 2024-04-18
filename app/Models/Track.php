<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Track extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'number',
    ];
    
    public function parcel():HasOne
    {
        return $this->hasOne(Parcel::class);
    }
}
