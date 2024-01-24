<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proposal>
 */
class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Team::factory()->create(),
            'client_id' => Client::factory()->create(),
            'code' => fake()->bothify('####/####'),
            'valid_until' => now()->addDays(15),
            'items' => [
                [
                    'description' => fake()->sentence(),
                    'quantity' => fake()->numberBetween(1, 10),
                    'unit_price' => fake()->numberBetween(100, 1000),
                ],
            ],
        ];
    }
}
