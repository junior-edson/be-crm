<?php

namespace Tests\Unit;

use App\Enums\EnumClientTaxType;
use App\Enums\EnumClientType;
use App\Http\Requests\CreateClientRequest;
use App\Models\Team;
use App\Services\CreateClientService;
use Illuminate\Http\Client\Request;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    public function testCreateIndividualClient()
    {
        $payload = [
            'team_id' => Team::factory()->create()->id,
            'type' => EnumClientType::INDIVIDUAL,
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'registration_code' => null,
            'address' => '123 Main St',
            'phone' => '1234567890',
            'email' => 'test@email.com',
        ];
        $request = new CreateClientRequest($payload);

        $service = new CreateClientService();
        $service->execute($request);

        $this->assertDatabaseCount('clients', 1);
        $this->assertDatabaseHas('clients', $payload);
    }
}
