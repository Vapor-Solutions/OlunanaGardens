<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title'
    ];

    function bookings() {
        return $this->hasMany(Booking::class);
    }

    function photos(){
        return $this->hasMany(Gallery::class);
    }

}
