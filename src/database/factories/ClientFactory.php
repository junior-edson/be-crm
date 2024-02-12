<?php

namespace Database\Factories;

use App\Enums\EnumClientTaxType;
use App\Enums\EnumClientType;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_id' => Team::factory()->create(),
            'type' => EnumClientType::INDIVIDUAL,
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'name' => $this->faker->name(),
            'registration_code' => null,
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'is_npo' => false,
            'is_building_older_than_10_years' => false,
        ];
    }
}
