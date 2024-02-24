<?php

namespace App\Services\Quotation;

use App\Http\Requests\Quotation\CreateQuotationRequest;
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

        $itemsData = [];
        foreach ($data['description'] as $key => $description) {
            $itemsData[] = [
                'description' => $description,
                'quantity' => $data['quantity'][$key],
                'unit_price' => $data['unit_price'][$key],
            ];
        }

        $quotation->items()->createMany($itemsData);

        return $quotation;
    }
}
