<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(['slug' => 'seminar'], ['name' => 'Seminar', 'type' => 'event']);
        Category::firstOrCreate(['slug' => 'workshop'], ['name' => 'Workshop', 'type' => 'event']);
        Category::firstOrCreate(['slug' => 'competition'], ['name' => 'Competition', 'type' => 'event']);
        Category::firstOrCreate(['slug' => 'berita'], ['name' => 'Berita', 'type' => 'blog']);
        Category::firstOrCreate(['slug' => 'artikel'], ['name' => 'Artikel', 'type' => 'blog']);
        Category::firstOrCreate(['slug' => 'tutorial'], ['name' => 'Tutorial', 'type' => 'blog']);
    }
}
