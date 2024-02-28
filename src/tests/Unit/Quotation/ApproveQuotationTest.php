<?php

namespace Tests\Unit\Quotation;

use App\Enums\EnumQuotationStatus;
use App\Models\Quotation;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\ApproveQuotationService;
use Tests\TestCase;

class ApproveQuotationTest extends TestCase
{
    public function testApproveValidQuotation(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $quotation = Quotation::factory()->create([
            'status' => EnumQuotationStatus::SENT->value
        ]);

        $service = new ApproveQuotationService();
        $response = $service->execute($quotation->id);

        $this->assertEquals(EnumQuotationStatus::APPROVED->value, $response->status);
    }
}
