<?php

namespace App\Services\DocuSign;

use DocuSign\eSign\Client\ApiException;
use DocuSign\eSign\Model\CarbonCopy;
use DocuSign\eSign\Model\Document;
use DocuSign\eSign\Model\EnvelopeDefinition;
use DocuSign\eSign\Model\Signer;

class SignViaEmailService
{
    public function execute(array $args, $clientService, $document)
    {
        # Create the envelope request object
        $envelope_definition = self::makeEnvelope(
            $args["envelope_args"],
            $clientService,
            $document,
        );
        $envelope_api = $clientService->getEnvelopeApi();

        # Call Envelopes::create API method
        # Exceptions will be caught by the calling function
        try {
            $envelopeResponse = $envelope_api->createEnvelope($args['account_id'], $envelope_definition);
        } catch (ApiException $e) {
            $clientService->showErrorTemplate($e);
            exit;
        }

        return ['envelope_id' => $envelopeResponse->getEnvelopeId()];
    }

    /**
     * @param array $args
     * @param $clientService
     * @param $document
     * @return EnvelopeDefinition
     */
    private function makeEnvelope(array $args, $clientService, $document): EnvelopeDefinition
    {
        # document (pdf)  has sign here anchor tag /sn1/
        #
        # The envelope has two recipients.
        # recipient 1 - signer
        # recipient 2 - cc
        # The envelope will be sent first to the signer.
        # After it is signed, a copy is sent to the cc person.
        #
        # create the envelope definition
        $envelope_definition = new EnvelopeDefinition([
            'email_subject' => 'Please sign this document set'
        ]);
        $content_bytes = file_get_contents($document);
        $doc_b64 = base64_encode($content_bytes);

        # Create the document models
        $document = new Document([  # create the DocuSign document object
            'document_base64' => $doc_b64,
            'name' => 'Lorem Ipsum',  # can be different from actual file name
            'file_extension' => 'pdf',  # many different document types are accepted
            'document_id' => '3'  # a label used to reference the doc
        ]);
        # The order in the docs array determines the order in the envelope
        $envelope_definition->setDocuments([$document]);

        # Create the signer recipient model
        $signer1 = new Signer([
            'email' => $args['signer_email'], 'name' => $args['signer_name'],
            'recipient_id' => "1", 'routing_order' => "1"]);
        # routingOrder (lower means earlier) determines the order of deliveries
        # to the recipients. Parallel routing order is supported by using the
        # same integer as the order for two or more recipients.

        # create a cc recipient to receive a copy of the documents
        /*$cc1 = new CarbonCopy([
            'email' => $args['cc_email'], 'name' => $args['cc_name'],
            'recipient_id' => "2", 'routing_order' => "2"
        ]);*/

        //return SMSDeliveryService::addSignersToTheDelivery($signer1, $cc1, $envelope_definition, $args);

        return $envelope_definition;
    }
}
