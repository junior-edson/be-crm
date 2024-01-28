<?php

namespace Database\Factories;

use App\Enums\EnumClientTaxType;
use App\Models\Client;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
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
            'client_id' => Client::factory()->create(),
            'issue_date' => now(),
            'due_date' => now()->addDays(5),
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'tax_rate' => 21,
            'currency' => 'EUR',
        ];
    }
}
