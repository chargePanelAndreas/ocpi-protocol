<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ClientInfo;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;

class HubClientInfo extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getClientInfo(string $countryCode, string $partyId): JsonResponse
    {
        $request = new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'GET', '/' . $countryCode . '/' . $partyId, null, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/HubClientInfo/clientInfoGetResponse.schema.json', static fn($data) => ClientInfoFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putClientInfo(string $countryCode, string $partyId, ClientInfo $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'PUT', '/' . $countryCode . '/' . $partyId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }
}
