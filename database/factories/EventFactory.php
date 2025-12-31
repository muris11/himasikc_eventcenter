<?php

namespace Database\Factories;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(5);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraphs(3, true),
            'date' => fake()->dateTimeBetween('now', '+1 year'),
            'location' => fake()->address(),
            'image_path' => null, // or fake image if needed
            'registration_link' => fake()->url(),
            'is_active' => fake()->boolean(80), // 80% chance active
            'event_category_id' => EventCategory::factory(),
            'participant_type' => fake()->randomElement(['individual', 'team', 'both']),
        ];
    }
}
