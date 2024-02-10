<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Enclosure extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'price',
        'weight_kg',
        'weight_g',
        'quantity',
        'description',
    ];
    
    public function parcels()
    {
        return $this->belongsToMany(Parcel::class);
    }
    
    
    
    
}
