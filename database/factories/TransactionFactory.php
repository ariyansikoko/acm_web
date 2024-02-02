<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'expense_id' => fake()->unique()->randomNumber(5, true),
            'project_id' => mt_rand(1, 2),
            'recipient_id' => mt_rand(1, 3),
            'amount' => fake()->numberBetween(100000, 1000000),
            'description' => fake()->sentence(2, 5),
            'category' => fake()->randomElement(['Biaya Perusahaan', 'DP Subcon', 'Comcase']),
            'type' => fake()->randomElement(['B Upah Tukang', 'B Penyambungan', 'B Perizinan', 'B QC & Uji Terima']),
            'requested_at' => fake()->dateTime(),
        ];
    }
}
