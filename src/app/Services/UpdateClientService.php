<?php

namespace App\Services;

use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Exception;

class UpdateClientService
{
    /**
     * @param UpdateClientRequest $request
     * @param string $clientId
     * @return void
     * @throws Exception
     */
    public function execute(UpdateClientRequest $request, string $clientId): void
    {
        $data = $request->all();
        $client = Client::find($clientId);

        if (!$client) {
            throw new Exception('Client not found');
        }

        $client->update($data);
    }
}
