<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\CreateClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Services\Client\CreateClientService;
use App\Services\Client\UpdateClientService;
use Exception;
use Illuminate\Http\JsonResponse;

class ClientManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(CreateClientRequest $request, CreateClientService $service): JsonResponse
    {
        try {
            $service->execute($request);

            return response()->json([], 204);
        } catch (Exception $e) {
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
    public function update(
        UpdateClientRequest $request,
        string $id,
        UpdateClientService $service
    ): JsonResponse {
        try {
            $service->execute($request, $id);

            return response()->json([], 204);
        } catch (Exception $e) {
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
