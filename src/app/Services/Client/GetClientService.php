<?php

namespace App\Services\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class GetClientService
{
    /**
     * @param string|null $id
     * @return mixed
     */
    public function execute(string|null $id = null): mixed
    {
        if (!$id) {
            return Client::where('team_id', Auth::user()->currentTeam->id)->get();
        }

        return Client::findOrFail($id);
    }
}
