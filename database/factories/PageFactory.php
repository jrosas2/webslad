<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->word().' '.fake()->word();

        return [
            'slug' => Str::slug($name),
            'name' => Str::title($name),
            'title' => fake()->sentence(5),
            'meta_title' => fake()->sentence(4),
            'meta_description' => fake()->sentence(12),
            'og_image' => null,
            'is_active' => true,
        ];
    }
}
