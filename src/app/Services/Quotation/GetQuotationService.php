<?php

namespace App\Services\Quotation;

use App\Models\Quotation;
use Illuminate\Support\Collection;

class GetQuotationService
{
    /**
     * @param string|null $status
     * @return Collection
     */
    public function getQuotationByStatus(string $status = null): Collection
    {
        if ($status) {
            return Quotation::where('status', $status)
                ->where('team_id', auth()->user()->currentTeam->id)
                ->orderByDesc('created_at')
                ->with('items')
                ->get();
        }

        return Quotation::orderByDesc('created_at')
            ->where('team_id', auth()->user()->currentTeam->id)
            ->with('items')
            ->get();
    }

    /**
     * @param string $id
     * @return Quotation
     */
    public function getQuotationById(string $id): Quotation
    {
        return Quotation::where('id', $id)
            ->where('team_id', auth()->user()->currentTeam->id)
            ->orderByDesc('created_at')
            ->with('items')
            ->firstOrFail();
    }
}
