<?php

namespace App\Http\Controllers;

use App\Enums\EnumQuotationStatus;
use App\Http\Requests\Quotation\CreateDraftQuotationRequest;
use App\Http\Requests\Quotation\CreateQuotationRequest;
use App\Services\Client\GetClientService;
use App\Services\Quotation\ApproveQuotationService;
use App\Services\Quotation\CreateDraftQuotationService;
use App\Services\Quotation\CreateQuotationService;
use App\Services\Quotation\DeleteQuotationService;
use App\Services\Quotation\GetQuotationService;
use App\Services\Quotation\RejectQuotationService;
use App\Services\Quotation\SendQuotationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
        addVendor('ckeditor-classic');

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
     * @param string $id
     * @param SendQuotationService $service
     * @return JsonResponse
     */
    public function send(string $id, SendQuotationService $service): JsonResponse
    {
        try {
            $quotation = $service->execute($id);

            return response()->json($quotation);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $id
     * @param ApproveQuotationService $service
     * @return JsonResponse
     */
    public function approve(string $id, ApproveQuotationService $service): JsonResponse
    {
        try {
            $quotation = $service->execute($id);

            return response()->json($quotation);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param string $id
     * @param RejectQuotationService $service
     * @return JsonResponse
     */
    public function reject(string $id, RejectQuotationService $service): JsonResponse
    {
        try {
            $quotation = $service->execute($id);

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
    public function edit(
        string $id,
        GetClientService $getClientService,
        GetQuotationService $getQuotationService
    ): RedirectResponse|View {
        addVendor('ckeditor-classic');

        $quotation = $getQuotationService->getQuotationById($id);

        if (
            $quotation->status === EnumQuotationStatus::DRAFT->value
            || $quotation->status === EnumQuotationStatus::REJECTED->value
        ) {
            return view('pages.apps.quotation.create')
                ->with('clients', $getClientService->execute())
                ->with('quotation', $quotation);
        } else {
            return redirect()->route('quotation.quotation.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        string $id,
        GetQuotationService $getQuotationService,
        DeleteQuotationService $deleteQuotationService
    ): JsonResponse {
        try {
            $quotation = $getQuotationService->getQuotationById($id);

            if ($quotation->status !== EnumQuotationStatus::DRAFT->value) {
                return response()->json(['message' => __('You are not allowed to delete a quotation other than draft')], 403);
            }

            $deleteQuotationService->execute($id);

            return response()->json([], 204);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
