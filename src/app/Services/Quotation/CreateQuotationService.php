<?php

namespace App\Services\Quotation;

use App\Http\Requests\Proposal\CreateQuotationRequest;
use App\Models\Quotation;
use Exception;

class CreateQuotationService
{
    /**
     * @param CreateQuotationRequest $request
     * @return Quotation
     * @throws Exception
     */
    public function execute(CreateQuotationRequest $request): Quotation
    {
        $data = $request->all();

        $quotation = new Quotation($data);
        $savedQuotation = $quotation->save();

        if (!$savedQuotation) {
            throw new Exception('Could not create quotation');
        }

        $quotation->items()->createMany($data['items']);

        return $quotation;
    }
}
