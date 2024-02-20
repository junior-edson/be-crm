<?php

namespace App\Services\Agenda;

use App\Http\Requests\Agenda\UpdateAgendaEventRequest;
use App\Models\AgendaEvent;
use Exception;

class UpdateAgendaEventService
{
    /**
     * @param UpdateAgendaEventRequest $request
     * @param int $agendaEventId
     * @return array
     * @throws Exception
     */
    public function execute(UpdateAgendaEventRequest $request, int $agendaEventId): array
    {
        $data = $request->all();
        $event = AgendaEvent::find($agendaEventId);

        if (!$event) {
            throw new Exception('Agenda event not found');
        }
        $event->update($data);

        return $data;
    }
}
