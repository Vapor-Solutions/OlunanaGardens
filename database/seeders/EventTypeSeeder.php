<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventTypes = [
            [
                'title' => "Anniversaries"
            ],
            [
                'title' => "Baby Shower"
            ],
            [
                'title' => "Bridal Shower"
            ],
            [
                'title' => "Birthdays"
            ],
            [
                'title' => "Corporate Events"
            ],
            [
                'title' => "Graduation Celebration"
            ],
            [
                'title' => "Photo and Video Shoots"
            ],
            [
                'title' => "Weddings"
            ],
        ];
        foreach ($eventTypes as $type) {
            EventType::create($type);
        }
    }
}
