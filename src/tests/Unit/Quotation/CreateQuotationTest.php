<?php

namespace Tests\Unit\Quotation;

use App\Enums\EnumClientTaxType;
use App\Http\Requests\Quotation\CreateQuotationRequest;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\CreateQuotationService;
use Carbon\Carbon;
use Tests\TestCase;
use Exception;

class CreateQuotationTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));
        $client = Client::factory()->create();

        $payload = [
            'client_id' => $client->id,
            'issue_date' => Carbon::now()->format('d/m/Y'),
            'due_date' => Carbon::now()->addDays(15)->format('d/m/Y'),
            'client_name' => $client->name,
            'client_email' => $client->email,
            'client_address' => $client->address,
            'company_name' => $team->name,
            'company_email' => $team->email,
            'company_address' => $team->address,
            'tax_type' => $client->tax_type,
            'currency' => 'EUR',
            'description' => [
                'Item 1',
                'Item 2',
            ],
            'quantity' => [
                1,
                2,
            ],
            'unit_price' => [
                100,
                200,
            ],
        ];
        $request = new CreateQuotationRequest($payload);

        $service = new CreateQuotationService();
        $createdQuotation = $service->execute($request);

        $this->assertDatabaseCount('quotations', 1);
        $this->assertDatabaseHas('quotations', [
            'team_id' => $team->id,
            'client_id' => $payload['client_id'],
            'due_date' => dateFormat($payload['due_date'], true),
        ]);

        $this->assertDatabaseCount('quotation_items', 2);
        $this->assertDatabaseHas('quotation_items', [
            'quotation_id' => $createdQuotation->id,
            'description' => $payload['description'][0],
            'quantity' => $payload['quantity'][0],
            'unit_price' => $payload['unit_price'][0],
        ]);
        $this->assertDatabaseHas('quotation_items', [
            'quotation_id' => $createdQuotation->id,
            'description' => $payload['description'][1],
            'quantity' => $payload['quantity'][1],
            'unit_price' => $payload['unit_price'][1],
        ]);
    }
}
