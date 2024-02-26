<?php

namespace App\Services\Quotation;

use App\Enums\EnumQuotationStatus;
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
        $data['status'] = EnumQuotationStatus::DRAFT->value;

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
