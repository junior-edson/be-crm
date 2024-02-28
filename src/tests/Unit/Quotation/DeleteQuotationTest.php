<?php

namespace Tests\Unit\Quotation;

use App\Models\Quotation;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\DeleteQuotationService;
use Tests\TestCase;

class DeleteQuotationTest extends TestCase
{
    public function testDeleteValidQuotation(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $quotation = Quotation::factory()->create();

        $this->assertDatabaseHas('quotations', ['id' => $quotation->id]);

        $service = new DeleteQuotationService();
        $service->execute($quotation->id);

        $this->assertDatabaseMissing('quotations', ['id' => $quotation->id]);
    }
}
