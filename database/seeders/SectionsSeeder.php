<?php

namespace Database\Seeders;

use App\Models\Section;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 40; $i++) {
            $section = new Section();
            $section->name = 'Section No. ' . $i + 1;
            $section->location = $faker->lastName;
            $section->save();
        }
    }
}
