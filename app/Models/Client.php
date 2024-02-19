<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasProfilePhoto;

class Client extends Model
{
    use HasFactory;
    use HasProfilePhoto;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'country',
    ];

    protected $appends = [
        'profile_photo_url',
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
