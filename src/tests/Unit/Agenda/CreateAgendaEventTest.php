<?php

namespace Tests\Unit\Agenda;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Models\Client;
use App\Models\Team;
use App\Models\User;
use App\Services\Agenda\CreateAgendaEventService;
use Carbon\Carbon;
use Tests\TestCase;

class CreateAgendaEventTest extends TestCase
{
    public function testCreateAgendaEventWithClient()
    {
        $team = Team::factory()->create();
        $this->actingAs(User::factory()->create(['current_team_id' => $team->id]));
        $client = Client::factory()->create();

        $payload = [
            'client_id' => $client->id,
            'name' => 'Test event',
            'initial_date' => Carbon::now()->addDays()->format('Y-m-d'),
            'initial_time' => Carbon::now()->addHour()->format('H:i'),
            'final_time' => Carbon::now()->addHours(2)->format('H:i'),
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
            'name' => 'Test event',
            'initial_date' => Carbon::now()->addDays()->format('Y-m-d'),
            'initial_time' => Carbon::now()->addHour()->format('H:i'),
            'final_time' => Carbon::now()->addHours(2)->format('H:i'),
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
