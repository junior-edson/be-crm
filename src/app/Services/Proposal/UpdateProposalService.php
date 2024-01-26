<?php

namespace App\Services\Proposal;

use App\Http\Requests\Proposal\UpdateProposalRequest;
use App\Models\Proposal;
use Exception;

class UpdateProposalService
{
    /**
     * @param UpdateProposalRequest $request
     * @param string $proposalId
     * @return Proposal
     * @throws Exception
     */
    public function execute(UpdateProposalRequest $request, string $proposalId): Proposal
    {
        $data = $request->all();
        $proposal = Proposal::find($proposalId);

        if (!$proposal) {
            throw new Exception('Proposal not found');
        }

        $proposal->update($data);

        $proposal->items()->delete();
        $proposal->items()->createMany($data['items']);

        return $proposal->refresh();
    }
}
