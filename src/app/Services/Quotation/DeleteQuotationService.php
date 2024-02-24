<?php

namespace App\Services\Quotation;

use App\Models\Quotation;

class DeleteQuotationService
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        return Quotation::where('id', $id)
            ->where('team_id', auth()->user()->currentTeam->id)
            ->delete();
    }
}
