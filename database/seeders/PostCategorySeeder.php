<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Teknologi', 'slug' => 'teknologi', 'description' => 'Artikel tentang perkembangan teknologi'],
            ['name' => 'Tips & Trik', 'slug' => 'tips-trik', 'description' => 'Tips dan trik untuk developer'],
            ['name' => 'Karir', 'slug' => 'karir', 'description' => 'Artikel tentang pengembangan karir'],
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'description' => 'Tutorial dan panduan praktis'],
            ['name' => 'Berita', 'slug' => 'berita', 'description' => 'Berita dan update terkini'],
            ['name' => 'Review', 'slug' => 'review', 'description' => 'Review produk dan layanan'],
            ['name' => 'Opini', 'slug' => 'opini', 'description' => 'Artikel opini dan pandangan'],
            ['name' => 'Inspirasi', 'slug' => 'inspirasi', 'description' => 'Artikel inspirasi dan motivasi'],
            ['name' => 'Event', 'slug' => 'event', 'description' => 'Berita tentang event dan kegiatan'],
            ['name' => 'Komunitas', 'slug' => 'komunitas', 'description' => 'Artikel tentang komunitas dan organisasi'],
        ];

        foreach ($categories as $category) {
            PostCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
