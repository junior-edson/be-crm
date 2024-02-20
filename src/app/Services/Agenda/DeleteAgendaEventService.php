<?php

namespace App\Services\Agenda;

use App\Models\AgendaEvent;

class DeleteAgendaEventService
{
    /**
     * @param int $id
     * @return void
     */
    public function execute(int $id): void
    {
        $event = AgendaEvent::find($id);

        if (!$event) {
            return;
        }

        $event->delete();
    }
}
