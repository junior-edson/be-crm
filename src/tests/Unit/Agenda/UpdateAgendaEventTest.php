<?php

namespace Tests\Unit\Agenda;

use App\Http\Requests\Agenda\UpdateAgendaEventRequest;
use App\Models\AgendaEvent;
use App\Services\Agenda\UpdateAgendaEventService;
use Carbon\Carbon;
use Exception;
use Tests\TestCase;

class UpdateAgendaEventTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testUpdateAgendaEvent(): void
    {
        $agendaEvent = AgendaEvent::factory()->create();
        $payload = [
            'name' => 'Updated name',
            'initial_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            'initial_time' => Carbon::now()->addHours(2)->format('H:i'),
            'address' => 'Updated address',
            'description' => 'Updated description',
        ];
        $request = new UpdateAgendaEventRequest($payload);

        $service = new UpdateAgendaEventService();
        $service->execute($request, $agendaEvent->id);

        $this->assertDatabaseCount('agenda_events', 1);
        $this->assertDatabaseHas('agenda_events', $payload);
    }

    public function testExpectedExceptionIfAgendaEventNotFound(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Agenda event not found');

        $service = new UpdateAgendaEventService();
        $service->execute(new UpdateAgendaEventRequest([]), 1);
    }
}
