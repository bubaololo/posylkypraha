<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcel extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    

    
    public function enclosure()
    {
        return $this->belongsToMany(Enclosure::class)->withPivot(['quantity']);
    }
    
    public function recipient_credential()
    {
        return $this->belongsTo(RecipientCredential::class);
    }
    public function sender_credential()
    {
        return $this->belongsTo(SenderCredential::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
