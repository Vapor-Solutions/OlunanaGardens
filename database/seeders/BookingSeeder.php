<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Client;
use App\Models\EventType;
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
            $booking->event_type_id = random_int(1, count(EventType::all()));

            $booking->client_id = random_int(1, count(Client::all()));
            $random = random_int(1, 300);
            $booking->start_time = Carbon::parse("Today at 7:30 a.m.")->subDays($random)->toDateTimeString();
            $booking->end_time = Carbon::parse($booking->end_time)->addHours(rand(2, 12))->toDateTimeString();
            $booking->created_by = 1;
            foreach ($booking->sections as $key => $section) {
                if ($booking->section->isBookedBetween($booking->start_time, $booking->end_time)) {
                    continue;
                } else {
                    $booking->save();
                    $booking->sections()->attach(rand(1, count(Section::all())));
                }
            }
        }
    }
}
