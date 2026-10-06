<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Sender;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\FinancialAdviceConfirmationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialTerminal;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TerminalActivation;

class Payments extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getTerminals(?JsonRequest $request = null): JsonResponse
    {
        $request = $request ?? new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/terminals', null, []);
        return (new JsonService($this->ocpiConfiguration))->listing($request, 'V2_3_0/Sender/Payments/terminalGetListingResponse.schema.json', null, static fn($data) => TerminalFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getTerminal(string $terminalId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/terminals/' . $terminalId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Sender/Payments/terminalGetResponse.schema.json', static fn($data) => TerminalFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putTerminal(string $terminalId, Terminal $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'PUT', '/terminals/' . $terminalId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function patchTerminal(string $terminalId, PartialTerminal $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'PATCH', '/terminals/' . $terminalId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function activateTerminal(TerminalActivation $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/terminals/activate', $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function deactivateTerminal(string $terminalId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'POST', '/terminals/' . $terminalId . '/deactivate', null, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getFinancialAdviceConfirmations(?JsonRequest $request = null): JsonResponse
    {
        $request = $request ?? new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/financial-advice-confirmations', null, []);
        return (new JsonService($this->ocpiConfiguration))->listing($request, 'V2_3_0/Sender/Payments/financialAdviceConfirmationGetListingResponse.schema.json', null, static fn($data) => FinancialAdviceConfirmationFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getFinancialAdviceConfirmation(string $financialAdviceConfirmationId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::PAYMENTS(), 'GET', '/financial-advice-confirmations/' . $financialAdviceConfirmationId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Sender/Payments/financialAdviceConfirmationGetResponse.schema.json', static fn($data) => FinancialAdviceConfirmationFactory::fromJson($data));
    }
}
