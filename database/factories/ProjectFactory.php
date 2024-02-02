<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->sentence(mt_rand(3, 6)),
            'project_id' => fake()->unique()->randomNumber(6, true),
            'location' => fake()->randomElement(['Medan', 'Jambi', 'Ridar']),
            'type' => fake()->randomElement(['MTEL', 'HEM', 'Node B']),
            'boq_plan' => fake()->numberBetween(100000, 10000000),
            'comcase' => fake()->numberBetween(50000, 200000),
            'boq_desc' => fake()->randomElement(['Sudah nilai rekon', 'Belum fix nilai rekon']),
            'project_date' => fake()->date(),
        ];
    }
}
