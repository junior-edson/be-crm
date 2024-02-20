<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgendaEvent>
 */
class AgendaEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => null,
            'name' => $this->faker->sentence(),
            'initial_date' => now()->add(1, 'day')->format('Y-m-d'),
            'final_date' => now()->add(2, 'day')->format('Y-m-d'),
            'initial_time' => now()->add(1, 'hour')->format('H:i'),
            'final_time' => now()->add(2, 'hour')->format('H:i'),
            'address' => $this->faker->address(),
            'description' => $this->faker->sentence(),
        ];
    }
}
