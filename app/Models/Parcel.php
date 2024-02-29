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
        return $this->belongsTo(RecipientCredential::class, 'recipient_credentials_id');
    }
    public function sender()
    {
        return $this->belongsTo(SenderCredential::class, 'sender_credentials_id');
    }
    
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
