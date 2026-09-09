<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $filename = fake()->unique()->uuid().'.webp';

        return [
            'disk' => 'public',
            'path' => 'site/'.$filename,
            'filename' => $filename,
            'alt_text' => fake()->sentence(4),
            'mime_type' => 'image/webp',
            'size' => fake()->numberBetween(1024, 1048576),
        ];
    }
}
