<?php

namespace Tests\Unit\Agenda;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Models\Client;
use App\Services\Agenda\CreateAgendaEventService;
use Carbon\Carbon;
use Tests\TestCase;

class CreateAgendaEventTest extends TestCase
{
    public function testCreateAgendaEventWithClient()
    {
        $client = Client::factory()->create();

        $payload = [
            'client_id' => $client->id,
            'event_datetime' => Carbon::now()->addDays()->format('Y-m-d H:i'),
            'address' => '123 Main St',
            'description' => 'Test description',
        ];
        $request = new CreateAgendaEventRequest($payload);

        $service = new CreateAgendaEventService();
        $service->execute($request);

        $this->assertDatabaseCount('agenda_events', 1);
        $this->assertDatabaseHas('agenda_events', $payload);
    }

    public function testCreateAgendaEventWithoutClient()
    {
        $payload = [
            'event_datetime' => Carbon::now()->addDays()->format('Y-m-d H:i'),
            'address' => '123 Main St',
            'description' => 'Test description',
        ];
        $request = new CreateAgendaEventRequest($payload);

        $service = new CreateAgendaEventService();
        $service->execute($request);

        $this->assertDatabaseCount('agenda_events', 1);
        $this->assertDatabaseHas('agenda_events', $payload);
    }
}
