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
                'title' => "Anniversaries",
                'price' => 5600
            ],
            [
                'title' => "Baby Shower",
                'price' => 5600
            ],
            [
                'title' => "Bridal Shower",
                'price' => 5600
            ],
            [
                'title' => "Birthdays",
                'price' => 5600
            ],
            [
                'title' => "Corporate Events",
                'price' => 5600
            ],
            [
                'title' => "Graduation Celebration",
                'price' => 5600
            ],
            [
                'title' => "Photo and Video Shoots",
                'price' => 5600
            ],
            [
                'title' => "Weddings",
                'price' => 5600
            ],
        ];
        foreach ($eventTypes as $type) {
            EventType::create($type);
        }
    }
}
