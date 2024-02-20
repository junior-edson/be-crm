<?php

namespace Tests\Unit\Client;

use App\Models\Client;
use App\Models\Team;
use App\Services\Client\GetClientService;
use Tests\TestCase;

class GetClientServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->team = Team::factory()->create();
        $this->actingAs($this->team->owner);
        Client::factory()->count(5)->create();
    }

    public function testGetAllClientsFromTeam()
    {
        $service = new GetClientService();
        $response = $service->execute();

        $this->assertCount(5, $response);
    }

    public function testGetClientById()
    {
        $service = new GetClientService();
        $response = $service->execute($this->team->clients[0]->id);

        $this->assertEquals($this->team->clients[0]->id, $response->id);
    }
}
