<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PageSection>
 */
class PageSectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'section_key' => fake()->unique()->slug(3),
            'title' => fake()->sentence(5),
            'subtitle' => fake()->sentence(12),
            'content' => ['body' => fake()->paragraph()],
            'sort_order' => 0,
            'is_active' => true,
        ];
    }
}
