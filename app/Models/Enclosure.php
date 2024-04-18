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
        'parcel_id',
        'price',
        'weight_kg',
        'weight_g',
        'quantity',
        'description',
        'value'
    ];
    
    public function parcels()
    {
        return $this->belongsTo(Parcel::class);
    }
    
    
    
    
}
