<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'aihe' => $this->faker->sentence(),
            'palaute' => $this->faker->paragraph(),
            'email' => $this->faker->safeEmail(),
            'status' => $this->faker->randomElement(['answered', 'closed', 'suggested']),
        ];
    }
}
