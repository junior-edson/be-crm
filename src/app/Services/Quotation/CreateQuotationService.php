<?php

namespace App\Services\Quotation;

use App\Enums\EnumQuotationStatus;
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
        $data['status'] = EnumQuotationStatus::PENDING->value;

        if (isset($data['issue_date'])) {
            $data['issue_date'] = dateFormat($data['issue_date'], true);
        }

        if (isset($data['due_date'])) {
            $data['due_date'] = dateFormat($data['due_date'], true);
        }

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
            $itemsData = getQuotationItems($data);
            $quotation->items()->delete();
            $quotation->items()->createMany($itemsData);
        }

        return $quotation;
    }
}
