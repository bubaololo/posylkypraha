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
    
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
    
    
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($product) {
            $product->slugify();
        });
    }
    
    
}
