<?php

namespace App\Services\Client;

use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Client;

class CreateClientService
{
    /**
     * @param CreateClientRequest $request
     * @return void
     */
    public function execute(CreateClientRequest $request): void
    {
        $data = $request->all();

        $client = new Client($data);
        $client->save();
    }
}
