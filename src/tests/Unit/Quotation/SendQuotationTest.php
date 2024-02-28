<?php

namespace Tests\Unit\Quotation;

use App\Enums\EnumQuotationStatus;
use App\Models\Quotation;
use App\Models\Team;
use App\Models\User;
use App\Services\Quotation\SendQuotationService;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class SendQuotationTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testSendQuotationAndChangeStatus(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $quotation = Quotation::factory()->create([
            'team_id' => $team->id,
            'status' => EnumQuotationStatus::PENDING->value
        ]);

        $service = new SendQuotationService();
        $quotation = $service->execute($quotation->id);

        $this->assertEquals(EnumQuotationStatus::SENT->value, $quotation->status);
    }

    public function testSendQuotationAndExpectErrorWhenQuotationNotFound(): void
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Quotation not found');

        $service = new SendQuotationService();
        $service->execute(Uuid::uuid4());
    }
}
