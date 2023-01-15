<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->words(3, true);
            $post->slug = Str::slug($post->title, '-');
            $post->content = $faker->paragraph();
            $post->category_id = $faker->words(4, true);
            $post->link_git = $faker->url();
            $post->lvl_diff = $faker->numberBetween(1,10);
            $post->save();
        }
    }
}
