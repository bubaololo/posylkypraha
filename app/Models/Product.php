<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'slug',
    ];
    
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
    
    public function productImage() {
        return $this->hasMany(ProductImage::class);
    }
    
    public function slugify()
    {
        $this->slug = Str::slug($this->name.$this->weight.'gramm'.$this->price.'rub');
    }
    
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($product) {
            $product->slugify();
        });
    }
    protected function image_path(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Storage::url($value),
        );
    }
    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                $image = $this->productImage()->where('primary', true)->first();
                return $image?->file;
            }
        );
    }

}
