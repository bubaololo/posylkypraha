<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    
//    public function products() {
//        return $this->hasManyThrough(Product::class, OrderProduct::class,
//        );
//    }

//    public function products() {
//        return $this->hasMany(OrderProduct::class);
//    }
    
    public function product()
    {
        return $this->belongsToMany(Product::class)->withPivot(['quantity']);
    }
    
    public function credential()
    {
        return $this->belongsTo(Credential::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
