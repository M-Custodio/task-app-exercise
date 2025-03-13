<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'description' => $this->faker->sentence(5),
            'status' => $this->faker->randomElement(['in-progress', 'completed']),
            'user_id' => 1,
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+2 weeks')->format('Y-m-d'),
        ];
    }
}
