<?php

namespace App\Services\Quotation;

use App\Http\Requests\Proposal\UpdateQuotationRequest;
use App\Models\Quotation;
use Exception;

class UpdateQuotationService
{
    /**
     * @param UpdateQuotationRequest $request
     * @param string $quotationId
     * @return Quotation
     * @throws Exception
     */
    public function execute(UpdateQuotationRequest $request, string $quotationId): Quotation
    {
        $data = $request->all();
        $quotation = Quotation::find($quotationId);

        if (!$quotation) {
            throw new Exception('Proposal not found');
        }

        $quotation->update($data);

        $quotation->items()->delete();
        $quotation->items()->createMany($data['items']);

        return $quotation->refresh();
    }
}
