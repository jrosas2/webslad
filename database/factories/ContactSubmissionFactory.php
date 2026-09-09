<?php

namespace Database\Factories;

use App\ContactSubmissionStatus;
use App\Models\ContactSubmission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'submission_token' => fake()->uuid(),
            'name' => fake()->name(),
            'company' => fake()->company(),
            'position' => fake()->jobTitle(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'estimated_users' => '6-15',
            'needs' => ['causas', 'documentos'],
            'message' => fake()->paragraph(),
            'status' => ContactSubmissionStatus::Nuevo,
            'ip_address' => fake()->ipv4(),
        ];
    }
}
