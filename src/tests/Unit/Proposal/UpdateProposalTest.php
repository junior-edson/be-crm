<?php

namespace Tests\Unit\Proposal;

use App\Http\Requests\Quotation\UpdateQuotationRequest;
use App\Models\Quotation;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\UpdateQuotationService;
use Carbon\Carbon;
use Tests\TestCase;

class UpdateProposalTest extends TestCase
{
    public function testUpdateProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $proposal = Quotation::factory()->create(['team_id' => $team->id]);

        $payload = [
            'valid_until' => Carbon::now()->addDays(25)->format('Y-m-d'),
            'items' => [
                [
                    'quantity' => 1,
                    'unit_type' => 'm²',
                    'unit_price' => 100,
                    'description' => 'Item 1',
                ],
                [
                    'quantity' => 2,
                    'unit_type' => 'm²',
                    'unit_price' => 200,
                    'description' => 'Item 2',
                ],
            ],
        ];
        $request = new UpdateQuotationRequest($payload);

        $service = new UpdateQuotationService();
        $updatedProposal = $service->execute($request, $proposal->id);

        $this->assertDatabaseCount('proposals', 1);
        $this->assertDatabaseHas('proposals', [
            'valid_until' => $payload['valid_until'],
        ]);
        $this->assertSame($payload['items'], $updatedProposal->items);
    }
}
