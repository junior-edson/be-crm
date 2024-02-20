<?php

namespace App\Http\Controllers;

use App\Http\Requests\Proposal\CreateProposalRequest;
use App\Services\Proposal\CreateProposalItemService;
use App\Services\Proposal\CreateProposalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class ProposalController extends Controller
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
    public function store(
        CreateProposalRequest $request,
        CreateProposalService $proposalService
    ): JsonResponse {
        try {
            $proposal = $proposalService->execute($request);

            return response()->json($proposal);
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
