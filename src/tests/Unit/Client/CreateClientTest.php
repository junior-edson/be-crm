<?php

namespace Tests\Unit\Client;

use App\Enums\EnumClientTaxType;
use App\Enums\EnumClientType;
use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Team;
use App\Models\User;
use App\Services\Client\CreateClientService;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    public function testCreateIndividualClient()
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $payload = [
            'team_id' => $team->id,
            'type' => EnumClientType::INDIVIDUAL,
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'name' => 'Test Name',
            'registration_code' => null,
            'address' => '123 Main St',
            'phone' => '1234567890',
            'email' => 'test@email.com',
            'is_npo' => false,
            'is_building_older_than_10_years' => true,
        ];
        $request = new CreateClientRequest($payload);

        $service = new CreateClientService();
        $service->execute($request);

        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseHas('clients', $payload);
    }
}
