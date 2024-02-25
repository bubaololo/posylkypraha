<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderCredential extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    public function parcels()
    {
        return $this->belongsToMany(Parcel::class);
    }
}
