<?php

namespace App\Http\Controllers;

use App\Http\Requests\Agenda\CreateAgendaEventRequest;
use App\Http\Requests\Agenda\UpdateAgendaEventRequest;
use App\Services\Agenda\CreateAgendaEventService;
use App\Services\Agenda\UpdateAgendaEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class AgendaEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('pages.apps.agenda.event.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CreateAgendaEventRequest $request,
        CreateAgendaEventService $service
    ): JsonResponse {
        try {
            $service->execute($request);

            return response()->json([], 204);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaEventRequest $request, int $id): JsonResponse
    {
        try {
            $service = new UpdateAgendaEventService();
            $service->execute($request, $id);

            return response()->json([], 204);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
