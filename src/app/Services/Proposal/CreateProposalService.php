<?php

namespace App\Services\Proposal;

use App\Http\Requests\Proposal\CreateProposalRequest;
use App\Models\Proposal;

class CreateProposalService
{
    /**
     * @param CreateProposalRequest $request
     * @return Proposal
     */
    public function execute(CreateProposalRequest $request): Proposal
    {
        $data = $request->all();

        $proposal = new Proposal($data);
        $proposal->save();

        return $proposal;
    }
}
