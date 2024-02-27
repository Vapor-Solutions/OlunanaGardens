<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
use App\Models\Package;
use App\Models\Section;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1500; $i++) {
            $booking = new Booking();
            $booking->event_type_id = rand(1, count(EventType::all()));

            $booking->package_id = rand(1, count(Package::all()));
            $booking->client_id = rand(1, count(Client::all()));
            $random = rand(1, 300);
            $booking->start_time = Carbon::parse("2024-02-20")->subDays($random)->toDateTimeString();
            $booking->end_time = Carbon::parse($booking->start_time)->addHours(rand(2, 72))->toDateTimeString();
            $booking->price = $booking->package->price;
            $booking->capacity_adults = rand(10, 1000);
            $booking->capacity_children = rand(10, 1000);
            $randomSection = rand(1, count(Section::all()));
            if (Section::find($randomSection)->isBookedBetween($booking->start_time, $booking->end_time)) {
                continue;
            } else {
                $booking->save();
                $booking->sections()->attach($randomSection);
            }
        }
    }
}
