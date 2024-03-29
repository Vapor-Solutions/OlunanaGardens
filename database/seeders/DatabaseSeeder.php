<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ClientsSeeder::class,
            EventTypeSeeder::class,
            PaymentMethodSeeder::class,
            SectionsSeeder::class,
            PackageSeeder::class,
            BookingSeeder::class,
            TestimonialSeeder::class,
            MenuSeeder::class,
            PostCategorySeeder::class,
            PostSeeder::class,
        ]);
    }
}
