<?php

namespace Tests\Unit\Invoice;

use App\Http\Requests\Invoice\CreateInvoiceWithoutProposalRequest;
use App\Http\Requests\Invoice\CreateInvoiceWithProposalRequest;
use App\Models\Client;
use App\Models\ProposalItem;
use App\Models\Team;
use App\Models\User;
use App\Services\Invoice\CreateInvoiceService;
use Illuminate\Support\Str;
use Tests\TestCase;
use Exception;

class CreateInvoiceTest extends TestCase
{
    public function testCreateInvoiceWithoutProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $payload = [
            'team_id' => $team->id,
            'client_id' => Client::factory()->create()->id,
            'issue_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'tax_type' => 'vat',
            'tax_rate' => 21,
            'currency' => 'EUR',
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
        $request = new CreateInvoiceWithoutProposalRequest($payload);

        $service = new CreateInvoiceService();
        $createdInvoice = $service->executeWithoutProposal($request);

        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseHas('invoices', [
            'client_id' => $payload['client_id'],
            'issue_date' => $payload['issue_date'],
            'due_date' => $payload['due_date'],
            'tax_type' => $payload['tax_type'],
            'tax_rate' => $payload['tax_rate'],
            'currency' => $payload['currency'],
        ]);

        $this->assertDatabaseCount('invoice_items', 2);
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $createdInvoice->id,
            'description' => $payload['items'][0]['description'],
            'unit_type' => $payload['items'][0]['unit_type'],
            'quantity' => $payload['items'][0]['quantity'],
            'unit_price' => $payload['items'][0]['unit_price'],
        ]);
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $createdInvoice->id,
            'description' => $payload['items'][1]['description'],
            'unit_type' => $payload['items'][1]['unit_type'],
            'quantity' => $payload['items'][1]['quantity'],
            'unit_price' => $payload['items'][1]['unit_price'],
        ]);
    }

    /**
     * @throws Exception
     */
    public function testCreateInvoiceWithProposal(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $proposalItems = ProposalItem::factory()->create();

        $payload = [
            'proposal_id' => $proposalItems->proposal_id,
            'team_id' => $team->id,
            'client_id' => Client::factory()->create()->id,
            'issue_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'tax_type' => 'VAT',
            'tax_rate' => 21,
            'currency' => 'EUR',
        ];
        $request = new CreateInvoiceWithProposalRequest($payload);

        $service = new CreateInvoiceService();
        $createdInvoice = $service->executeWithProposal($request);

        $this->assertDatabaseCount('invoices', 1);
        $this->assertDatabaseHas('invoices', [
            'client_id' => $payload['client_id'],
            'issue_date' => $payload['issue_date'],
            'due_date' => $payload['due_date'],
            'tax_type' => $payload['tax_type'],
            'tax_rate' => $payload['tax_rate'],
            'currency' => $payload['currency'],
        ]);

        $this->assertDatabaseCount('invoice_items', 1);
        $this->assertDatabaseHas('invoice_items', [
            'invoice_id' => $createdInvoice->id,
            'description' => $proposalItems->description,
            'unit_type' => $proposalItems->unit_type,
            'quantity' => $proposalItems->quantity,
            'unit_price' => $proposalItems->unit_price,
        ]);
    }

    /**
     * @throws Exception
     */
    public function testCreateInvoiceWithMissingProposalItems(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $payload = [
            'proposal_id' => Str::uuid()->toString(),
            'team_id' => $team->id,
            'client_id' => Client::factory()->create()->id,
            'issue_date' => now()->format('Y-m-d'),
            'due_date' => now()->addDays(5)->format('Y-m-d'),
            'tax_type' => 'VAT',
            'tax_rate' => 21,
            'currency' => 'EUR',
        ];
        $request = new CreateInvoiceWithProposalRequest($payload);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Proposal items not found');

        $service = new CreateInvoiceService();
        $service->executeWithProposal($request);
    }
}
