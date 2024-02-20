<?php

namespace App\Services\Proposal;

use App\Http\Requests\Proposal\CreateProposalRequest;
use App\Models\Proposal;
use Exception;

class CreateProposalService
{
    /**
     * @param CreateProposalRequest $request
     * @return Proposal
     * @throws Exception
     */
    public function execute(CreateProposalRequest $request): Proposal
    {
        $data = $request->all();

        $proposal = new Proposal($data);
        $savedProposal = $proposal->save();

        if (!$savedProposal) {
            throw new Exception('Could not create proposal');
        }

        $proposal->items()->createMany($data['items']);

        return $proposal;
    }
}
