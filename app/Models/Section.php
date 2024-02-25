<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;



    public function bookings()
    {
        return $this->belongsToMany(Booking::class,'booking_section');
    }

    public function IsBooked($date)
    {
        foreach ($this->bookings as $booking) {
            if (Carbon::parse($date)->isBetween(Carbon::parse($booking->start_time)->subDay()->toDateString(), Carbon::parse($booking->end_time)->addDay()->toDateString())) {
                return true;
            }
        }
    }

    public function isBookedBetween($date1, $date2)
    {
        foreach ($this->bookings as $booking) {
            if ($booking->isActiveBetween($date1, $date2)) {
                return true;
            }
        }

        return false;
    }
}
