<?php

namespace App\Services\Quotation;

use App\Enums\EnumQuotationStatus;
use App\Models\Quotation;
use Exception;

class SendQuotationService
{
    public function execute(string $id): Quotation
    {
        $quotation = Quotation::where('id', $id)
            ->where('status', EnumQuotationStatus::PENDING->value)
            ->where('team_id', auth()->user()->currentTeam->id);

        if (!$quotation->exists()) {
            throw new Exception(__('Quotation not found'));
        }

        // TODO - send email with quotation

        $quotation->update([
            'status' => EnumQuotationStatus::SENT->value
        ]);

        return Quotation::findOrFail($id);
    }
}
