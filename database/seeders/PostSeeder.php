<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('post_categories')->pluck('id')->toArray();

        for ($i = 0; $i < 600; $i++) {
            DB::table('posts')->insert([
                'user_id' => 1, // Assuming the user_id is 1 for all posts
                'post_category_id' => $categories[array_rand($categories)],
                'title' => 'Post ' . ($i + 1),
                'slug' => 'post-' . ($i + 1),
                'blog_photo_path'=>'/img/news/5.jpg',
                'content' => $this->generateContent(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    private function generateContent()
    {
        $loremIpsum = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
        $content = $loremIpsum . ' ' . $loremIpsum . ' ' . $loremIpsum;
        return $content;
    }
}
