<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Testimonial;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $testimonial =  new Testimonial();
            $testimonial->client_id = random_int(1, count(Client::all()));
            $testimonial->rating = $faker->randomFloat(1, 1.5, 5);
            $testimonial->comment = $faker->realText(80);
            $testimonial->save();
        }
    }
}
