<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipientCredential extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function parcels()
    {
        return $this->belongsToMany(Parcel::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    
    public function getFullNameAttribute() :string
    {
        return "{$this->name} {$this->surname}";
    }
}
