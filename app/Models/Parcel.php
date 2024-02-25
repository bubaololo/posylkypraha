<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    

    
    public function enclosures()
    {
        return $this->hasMany(Enclosure::class);
    }
    
    public function recipient()
    {
        return $this->hasOne(RecipientCredential::class);
    }
    public function sender()
    {
        return $this->hasOne(SenderCredential::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
