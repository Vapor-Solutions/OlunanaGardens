<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Laravel\Jetstream\HasProfilePhoto;
use Psy\CodeCleaner\FunctionContextPass;

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


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function bookingRequests()
    {
        return $this->hasMany(BookingRequest::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }

    public function getPaymentsAttribute()
    {
        return $this->bookings()->with('payments')->get()->pluck('payments')->flatten();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

}
