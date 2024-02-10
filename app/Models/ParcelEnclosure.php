<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelEnclosure extends Model
{
    use HasFactory;
    protected $table = 'parcel_enclosure';
    protected $guarded = [];
    public $timestamps = false;
}
