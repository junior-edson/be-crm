<?php

namespace App\Services\Quotation;

use App\Enums\EnumQuotationStatus;
use App\Models\Quotation;
use Exception;

class ApproveQuotationService
{
    /**
     * @param string $id
     * @return Quotation
     * @throws Exception
     */
    public function execute(string $id): Quotation
    {
        $quotation = Quotation::where('id', $id)
            ->where('status', EnumQuotationStatus::SENT->value)
            ->where('team_id', auth()->user()->currentTeam->id);

        if (!$quotation->exists()) {
            throw new Exception(__('Quotation not found'));
        }

        $quotation->update([
            'status' => EnumQuotationStatus::APPROVED->value
        ]);

        return Quotation::findOrFail($id);
    }
}
