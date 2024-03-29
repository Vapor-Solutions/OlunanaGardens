<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'booking_section');
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }
    public function isActiveDuring($date)
    {
        if ($this->check_out) {
            return Carbon::parse($date)->between(Carbon::parse($this->check_in)->subDay()->toDateString(), Carbon::parse($this->check_out)->addDay()->toDateString());
        }

        return false;
    }

    public function isActiveBetween($date1, $date2)
    {
        if (Carbon::parse($date1)->lessThan(Carbon::parse($date2))) {
            if (Carbon::parse($date1)->lessThan(Carbon::parse($this->check_in))) {
                return Carbon::parse($date2)->greaterThanOrEqualTo(Carbon::parse($this->check_in));
            } elseif (Carbon::parse($date1)->isBetween(Carbon::parse($this->check_in)->toDate(), Carbon::parse($this->check_out)->toDate())) {
                return true;
            } elseif (Carbon::parse($date1)->greaterThanOrEqualTo(Carbon::parse($this->check_out))) {
                return false;
            }
        } elseif (Carbon::parse($date1)->greaterThanOrEqualTo(Carbon::parse($date2))) {
            if (Carbon::parse($date2)->lessThan(Carbon::parse($this->check_in))) {
                return Carbon::parse($date1)->greaterThanOrEqualTo(Carbon::parse($this->check_in));
            } elseif (Carbon::parse($date2)->isBetween(Carbon::parse($this->check_in)->toDate(), Carbon::parse($this->check_out)->toDate())) {
                return true;
            } elseif (Carbon::parse($date2)->greaterThanOrEqualTo(Carbon::parse($this->check_out))) {
                return false;
            }
        }
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    function getTotalCostAttribute()
    {
        return ($this->capacity_adults * $this->price) + ($this->capacity_children * $this->price * 0.5);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public  function checkBookingAvailability()
    {
    }
}
