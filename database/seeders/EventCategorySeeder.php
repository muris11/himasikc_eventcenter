<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Seeder;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Workshop', 'slug' => 'workshop', 'description' => 'Event workshop dan pelatihan'],
            ['name' => 'Seminar', 'slug' => 'seminar', 'description' => 'Event seminar dan kuliah umum'],
            ['name' => 'Kompetisi', 'slug' => 'kompetisi', 'description' => 'Kompetisi dan lomba'],
            ['name' => 'Konferensi', 'slug' => 'konferensi', 'description' => 'Konferensi dan forum diskusi'],
            ['name' => 'Gathering', 'slug' => 'gathering', 'description' => 'Gathering dan event sosial'],
            ['name' => 'Webinar', 'slug' => 'webinar', 'description' => 'Webinar online'],
            ['name' => 'Hackathon', 'slug' => 'hackathon', 'description' => 'Event hackathon dan coding'],
            ['name' => 'Networking', 'slug' => 'networking', 'description' => 'Event networking dan pertemuan'],
            ['name' => 'Pelatihan', 'slug' => 'pelatihan', 'description' => 'Pelatihan dan kursus'],
            ['name' => 'Festival', 'slug' => 'festival', 'description' => 'Festival dan acara besar'],
        ];

        foreach ($categories as $category) {
            EventCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
