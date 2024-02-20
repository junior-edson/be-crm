<?php

namespace Tests\Unit\Agenda;

use App\Models\AgendaEvent;
use App\Services\Agenda\GetAgendaEventService;
use Tests\TestCase;

class GetAgendaEventServiceTest extends TestCase
{
    public function testGetAllAgendaEvents(): void
    {
        AgendaEvent::factory()->count(5)->create();

        $service = new GetAgendaEventService();
        $response = $service->execute();

        $this->assertCount(5, $response);
    }
}
