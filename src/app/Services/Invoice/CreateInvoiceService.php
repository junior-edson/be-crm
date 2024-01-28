<?php

namespace App\Services\Invoice;

use App\Http\Requests\Invoice\CreateInvoiceWithoutProposalRequest;
use App\Http\Requests\Invoice\CreateInvoiceWithProposalRequest;
use App\Models\Invoice;
use App\Models\ProposalItem;
use Exception;

class CreateInvoiceService
{
    /**
     * @param CreateInvoiceWithoutProposalRequest $request
     * @return Invoice
     */
    public function executeWithoutProposal(CreateInvoiceWithoutProposalRequest $request): Invoice
    {
        $data = $request->all();

        $invoice = new Invoice($data);
        $invoice->save();
        $invoice->items()->createMany($data['items']);

        return $invoice;
    }

    /**
     * @param CreateInvoiceWithProposalRequest $request
     * @return Invoice
     * @throws Exception
     */
    public function executeWithProposal(CreateInvoiceWithProposalRequest $request): Invoice
    {
        $data = $request->all();

        $invoice = new Invoice($data);
        $invoice->save();

        $proposalItems = ProposalItem::where('proposal_id', $data['proposal_id'])->get()->toArray();

        if (!$proposalItems) {
            throw new Exception('Proposal items not found');
        }

        foreach ($proposalItems as $item) {
            unset($item['id'], $item['proposal_id']);
            $invoice->items()->create($item);
        }

        return $invoice;
    }
}
