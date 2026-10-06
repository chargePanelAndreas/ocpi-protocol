<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\FinancialAdviceConfirmationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\FinancialAdviceConfirmation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;

class Payments extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getTerminal(string $terminalId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/terminals/' . $terminalId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/Payments/terminalGetResponse.schema.json', static fn($data) => TerminalFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postTerminal(Terminal $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/terminals', $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getFinancialAdviceConfirmation(string $financialAdviceConfirmationId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/financial-advice-confirmations/' . $financialAdviceConfirmationId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/Payments/financialAdviceConfirmationGetResponse.schema.json', static fn($data) => FinancialAdviceConfirmationFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postFinancialAdviceConfirmation(FinancialAdviceConfirmation $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/financial-advice-confirmations', $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }
}
