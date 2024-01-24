<?php

namespace Tests\Unit\Client;

use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use App\Services\Client\UpdateClientService;
use Exception;
use Illuminate\Support\Str;
use Tests\TestCase;

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
        $service->execute(new UpdateClientRequest([]), Str::uuid()->toString());
    }
}
