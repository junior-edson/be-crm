<?php

namespace Tests\Unit\Quotation;


use App\Enums\EnumQuotationStatus;
use App\Models\Quotation;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\RejectQuotationService;
use Tests\TestCase;

class RejectQuotationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testRejectQuotation(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $quotation = Quotation::factory()->create([
            'status' => EnumQuotationStatus::SENT->value
        ]);

        $service = new RejectQuotationService();
        $response = $service->execute($quotation->id);

        $this->assertEquals(EnumQuotationStatus::REJECTED->value, $response->status);
    }
}
