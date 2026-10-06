<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Sender;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;

class HubClientInfo extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getClientInfoList(?JsonRequest $request = null): JsonResponse
    {
        $request = $request ?? new JsonRequest(ModuleId::HUB_CLIENT_INFO(), 'GET', '', null, []);
        return (new JsonService($this->ocpiConfiguration))->listing($request, 'V2_3_0/Sender/HubClientInfo/clientInfoGetListingResponse.schema.json', null, static fn($data) => ClientInfoFactory::fromJson($data));
    }
}
