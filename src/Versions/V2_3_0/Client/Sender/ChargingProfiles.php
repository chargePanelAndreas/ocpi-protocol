<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Sender;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ActiveChargingProfile;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use JsonSerializable;

class ChargingProfiles extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postChargingProfileResult(JsonSerializable $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::CHARGING_PROFILES(), 'POST', '/response', $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putActiveChargingProfile(string $sessionId, ActiveChargingProfile $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::CHARGING_PROFILES(), 'PUT', '/' . $sessionId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->status($request);
    }
}
