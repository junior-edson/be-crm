<?php

namespace Tests\Feature;

use App\Http\Requests\Proposal\CreateProposalRequest;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use App\Services\Proposal\CreateProposalService;
use Carbon\Carbon;
use Tests\TestCase;

class CreateProposalTest extends TestCase
{
    public function testCreateProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $payload = [
            'team_id' => $team->id,
            'client_id' => Client::factory()->create()->id,
            'valid_until' => Carbon::now()->addDays(15)->format('Y-m-d'),
            'items' => [
                [
                    'description' => 'Item 1',
                    'quantity' => 1,
                    'unit_price' => 100,
                ],
            ],
        ];
        $request = new CreateProposalRequest($payload);

        $service = new CreateProposalService();
        $createdProposal = $service->execute($request);

        $this->assertDatabaseCount('proposals', 1);
        $this->assertDatabaseHas('proposals', [
            'team_id' => $team->id,
            'client_id' => $payload['client_id'],
            'valid_until' => $payload['valid_until'],
        ]);
        $this->assertSame($payload['items'], $createdProposal->items);
    }
}
