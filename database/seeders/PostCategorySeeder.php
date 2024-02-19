<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('post_categories')->insert([
            ['title' => 'Gardening Tips'],
            ['title' => 'Garden Events'],
            ['title' => 'Plant Care'],
            ['title' => 'Garden Design'],
            ['title' => 'Garden News'],
            ['title' => 'Garden Tours'],
        ]);
    }
}
