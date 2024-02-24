<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quotation\CreateDraftQuotationRequest;
use App\Http\Requests\Quotation\CreateQuotationRequest;
use App\Services\Client\GetClientService;
use App\Services\Quotation\CreateDraftQuotationService;
use App\Services\Quotation\CreateProposalItemService;
use App\Services\Quotation\CreateQuotationService;
use App\Services\Quotation\GetQuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Illuminate\View\View;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetQuotationService $service): View
    {
        return view('pages.apps.quotation.index')
            ->with('quotations', $service->getQuotationByStatus());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GetClientService $getClientService): View
    {
        return view('pages.apps.quotation.create')
            ->with('clients', $getClientService->execute());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        CreateQuotationRequest $request,
        CreateQuotationService $quotationService
    ): JsonResponse {
        try {
            $quotation = $quotationService->execute($request);

            return response()->json($quotation);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param CreateDraftQuotationRequest $request
     * @param CreateDraftQuotationService $service
     * @return JsonResponse
     */
    public function draft(
        CreateDraftQuotationRequest $request,
        CreateDraftQuotationService $service
    ): JsonResponse {
        try {
            $quotation = $service->execute($request);

            return response()->json($quotation);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, GetQuotationService $service): View
    {
        $quotation = $service->getQuotationById($id);

        return view('pages.apps.quotation.show', compact('quotation'));
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
