<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Image;
use App\Models\Post;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        // Add images to posts
        $posts = Post::all();
        foreach ($posts as $post) {
            $numImages = $faker->numberBetween(0, 5); // 0 to 5 images per post
            for ($i = 0; $i < $numImages; $i++) {
                Image::create([
                    'imageable_type' => Post::class,
                    'imageable_id' => $post->id,
                    'path' => 'images/posts/'.$faker->uuid.'.jpg', // Placeholder path
                    'alt_text' => $faker->sentence(3),
                ]);
            }
        }

        // Add images to events
        $events = Event::all();
        foreach ($events as $event) {
            $numImages = $faker->numberBetween(0, 5); // 0 to 5 images per event
            for ($i = 0; $i < $numImages; $i++) {
                Image::create([
                    'imageable_type' => Event::class,
                    'imageable_id' => $event->id,
                    'path' => 'images/events/'.$faker->uuid.'.jpg', // Placeholder path
                    'alt_text' => $faker->sentence(3),
                ]);
            }
        }
    }
}
