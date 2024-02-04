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
            'project_id' => fake()->unique()->randomNumber(8, true),
            'client' => 'TA',
            'project_date' => fake()->dateTimeBetween('2020-01-01', 'now')->format('Y-m-d'),
            'title' => fake()->unique()->sentence(mt_rand(3, 6)),
            'episode' => '5',
            'location' => fake()->randomElement(['Medan', 'Jambi', 'Ridar', 'Lampung', 'Sumbar', 'Sumut']),
            'type' => fake()->randomElement(['MTEL', 'HEM', 'Node B', 'MITRATEL', 'PT2NS', 'QE', 'STTF']),
            'boq_plan' => fake()->numberBetween(400000, 2400000000),
            'comcase' => fake()->randomElement([0, 0, 0, 0, 0, 500000]),
            'boq_subcon' => fake()->numberBetween(1000000, 1000000000),
        ];
    }
}
