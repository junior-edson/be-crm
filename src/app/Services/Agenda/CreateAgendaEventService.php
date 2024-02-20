<?php

namespace App\Services\Agenda;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Models\AgendaEvent;

class CreateAgendaEventService
{
    /**
     * @param CreateAgendaEventRequest $request
     * @return AgendaEvent
     */
    public function execute(CreateAgendaEventRequest $request): AgendaEvent
    {
        $data = $request->all();

        $event = new AgendaEvent($data);
        $event->save();

        return $event;
    }
}
