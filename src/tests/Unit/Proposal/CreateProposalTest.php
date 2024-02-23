<?php

namespace Tests\Unit\Proposal;

use App\Enums\EnumClientTaxType;
use App\Http\Requests\Proposal\CreateQuotationRequest;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\CreateQuotationService;
use Carbon\Carbon;
use Tests\TestCase;
use Exception;

class CreateProposalTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCreateProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $payload = [
            'team_id' => $team->id,
            'client_id' => Client::factory()->create()->id,
            'valid_until' => Carbon::now()->addDays(15)->format('Y-m-d'),
            'tax_type' => EnumClientTaxType::TAX_21_PERCENT->personTaxes(),
            'items' => [
                [
                    'description' => 'Item 1',
                    'unit_type' => 'm²',
                    'quantity' => 1,
                    'unit_price' => 100,
                ],
                [
                    'description' => 'Item 2',
                    'unit_type' => 'm²',
                    'quantity' => 2,
                    'unit_price' => 200,
                ],
            ],
        ];
        $request = new CreateQuotationRequest($payload);

        $service = new CreateQuotationService();
        $createdProposal = $service->execute($request);

        $this->assertDatabaseCount('proposals', 1);
        $this->assertDatabaseHas('proposals', [
            'team_id' => $team->id,
            'client_id' => $payload['client_id'],
            'valid_until' => $payload['valid_until'],
        ]);

        $this->assertDatabaseCount('proposal_items', 2);
        $this->assertDatabaseHas('proposal_items', [
            'proposal_id' => $createdProposal->id,
            'description' => $payload['items'][0]['description'],
            'unit_type' => $payload['items'][0]['unit_type'],
            'quantity' => $payload['items'][0]['quantity'],
            'unit_price' => $payload['items'][0]['unit_price'],
        ]);
        $this->assertDatabaseHas('proposal_items', [
            'proposal_id' => $createdProposal->id,
            'description' => $payload['items'][1]['description'],
            'unit_type' => $payload['items'][1]['unit_type'],
            'quantity' => $payload['items'][1]['quantity'],
            'unit_price' => $payload['items'][1]['unit_price'],
        ]);
    }
}
