<?php

namespace App\Services\Agenda;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Models\AgendaEvent;

class CreateAgendaEventService
{
    /**
     * @param CreateAgendaEventRequest $request
     * @return void
     */
    public function execute(CreateAgendaEventRequest $request): void
    {
        $data = $request->all();

        $event = new AgendaEvent($data);
        $event->save();
    }
}
