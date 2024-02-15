<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'country',
    ];


    function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}