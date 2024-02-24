<?php

namespace App\Services\Quotation;

use App\Http\Requests\Quotation\CreateDraftQuotationRequest;
use App\Models\Quotation;
use Exception;

class CreateDraftQuotationService
{
    /**
     * @param CreateDraftQuotationRequest $request
     * @return Quotation
     * @throws Exception
     */
    public function execute(CreateDraftQuotationRequest $request): Quotation
    {
        $data = $request->all();
        $data['status'] = 'DRAFT';

        if (isset($data['quotation_id'])) {
            $quotation = Quotation::findOrFail($data['quotation_id']);
            $quotation->update($data);
        } else {
            $quotation = Quotation::create($data);
        }

        if (!$quotation) {
            throw new Exception('Could not create quotation');
        }

        if (!isset($data['description'])) {
            return $quotation;
        }

        if (!empty($data['description'])) {
            $itemsData = self::getQuotationItems($data);
            $quotation->items()->delete();
            $quotation->items()->createMany($itemsData);
        }

        return $quotation;
    }

    /**
     * @param array $data
     * @return array
     */
    private static function getQuotationItems(array $data): array
    {
        $itemsData = [];
        foreach ($data['description'] as $key => $description) {
            if ($description === '' || $description === null) {
                continue;
            }

            // Money formatting (it comes as € 1.123,50)
            $price = str_replace(['€ ', '.', ','], ['', '', '.'], $data['price'][$key]);

            $itemsData[] = [
                'description' => $description,
                'quantity' => $data['quantity'][$key],
                'unit_price' => $price,
            ];
        }

        return $itemsData;
    }
}
