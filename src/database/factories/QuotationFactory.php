<?php

namespace Database\Factories;

use App\Enums\EnumClientTaxType;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client = Client::factory()->create();
        $company = Team::factory()->create();

        return [
            'team_id' => Team::factory()->create(),
            'user_id' => User::factory()->create(),
            'client_id' => $client->id,
            'number' => fake()->bothify('####/####'),
            'issue_date' => now(),
            'due_date' => now()->addDays(15),
            'client_name' => $client->name,
            'client_email' => $client->email,
            'client_address' => $client->address,
            'company_name' => $company->name,
            'company_email' => $company->email,
            'company_address' => $company->address,
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'currency' => 'EUR',
            'notes' => fake()->text(),
            'status' => 'PENDING',
        ];
    }
}
