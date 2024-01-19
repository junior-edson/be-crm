<?php

namespace Tests\Unit;

use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\UpdateClientService;
use Tests\TestCase;
use Exception;

class UpdateClientTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testUpdateIndividualClient()
    {
        $client = Client::factory()->create();

        $payload = [
            'registration_code' => null,
            'phone' => '1234567890',
            'email' => 'test@email.com',
        ];
        $request = new UpdateClientRequest($payload);

        $this->assertDatabaseHas('clients', $client->toArray());

        $service = new UpdateClientService();
        $service->execute($request, $client->id);

        $this->assertDatabaseHas('clients', $payload);
    }

    public function testExceptionClientNotFound()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Client not found');

        $service = new UpdateClientService();
        $service->execute(new UpdateClientRequest([]), '123456789');
    }
}
