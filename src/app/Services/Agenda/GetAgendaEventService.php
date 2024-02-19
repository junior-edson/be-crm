<?php

namespace App\Services\Agenda;

use App\Models\AgendaEvent;

class GetAgendaEventService
{
    /**
     * @param int|null $id
     * @return mixed
     */
    public function execute(int|null $id = null): mixed
    {
        if (!$id) {
            return AgendaEvent::with('client')->get();
        }

        return AgendaEvent::with('client')->findOrFail($id);
    }
}
