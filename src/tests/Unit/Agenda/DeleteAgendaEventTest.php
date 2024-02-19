<?php

namespace Tests\Unit\Agenda;

use App\Models\AgendaEvent;
use App\Services\Agenda\DeleteAgendaEventService;
use Tests\TestCase;

class DeleteAgendaEventTest extends TestCase
{
    public function testDeleteAgendaEvent(): void
    {
        $event = AgendaEvent::factory()->create();

        $this->assertDatabaseCount('agenda_events', 1);

        $service = new DeleteAgendaEventService();
        $service->execute($event->id);

        $this->assertDatabaseCount('agenda_events', 0);
    }

    public function testDeleteWontBreakIfEventDoesntExist(): void
    {
        $this->assertDatabaseCount('agenda_events', 0);

        $service = new DeleteAgendaEventService();
        $service->execute(0);

        $this->assertDatabaseCount('agenda_events', 0);
    }
}
