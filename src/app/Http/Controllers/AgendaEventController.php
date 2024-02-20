<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Http\Requests\Agenda\UpdateAgendaEventRequest;
use App\Models\AgendaEvent;
use App\Services\Agenda\CreateAgendaEventService;
use App\Services\Agenda\DeleteAgendaEventService;
use App\Services\Agenda\GetAgendaEventService;
use App\Services\Agenda\UpdateAgendaEventService;
use App\Services\Client\GetClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AgendaEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(
        GetClientService $getClientService,
        GetAgendaEventService $getAgendaEventService
    ): View
    {
        addVendors(['fullcalendar']);

        return view('pages.apps.agenda.event.index')
                ->with('clients', $getClientService->execute())
                ->with('events', $getAgendaEventService->execute());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CreateAgendaEventRequest $request,
        CreateAgendaEventService $service
    ): JsonResponse {
        try {
            $event = $service->execute($request);

            return response()->json(['event' => $event], 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaEventRequest $request, int $id): JsonResponse
    {
        try {
            $service = new UpdateAgendaEventService();
            $data = $service->execute($request, $id);

            return response()->json($data, 201);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $service = new DeleteAgendaEventService();
            $service->execute($id);

            return response()->json([], 204);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
