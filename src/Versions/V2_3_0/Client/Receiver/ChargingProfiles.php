<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonResponse;
use Chargemap\OCPI\Versions\V2_3_0\Client\Generic\JsonService;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ChargingProfileResponseFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\SetChargingProfile;

class ChargingProfiles extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getActiveChargingProfile(string $sessionId, int $duration, string $responseUrl): JsonResponse
    {
        $request = new JsonRequest(ModuleId::CHARGING_PROFILES(), 'GET', '/' . $sessionId, null, ['duration' => $duration, 'response_url' => $responseUrl]);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/ChargingProfiles/chargingProfileResponse.schema.json', static fn($data) => ChargingProfileResponseFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function putChargingProfile(string $sessionId, SetChargingProfile $body): JsonResponse
    {
        $request = new JsonRequest(ModuleId::CHARGING_PROFILES(), 'PUT', '/' . $sessionId, $body, []);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/ChargingProfiles/chargingProfileResponse.schema.json', static fn($data) => ChargingProfileResponseFactory::fromJson($data));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function deleteChargingProfile(string $sessionId, string $responseUrl): JsonResponse
    {
        $request = new JsonRequest(ModuleId::CHARGING_PROFILES(), 'DELETE', '/' . $sessionId, null, ['response_url' => $responseUrl]);
        return (new JsonService($this->ocpiConfiguration))->object($request, 'V2_3_0/Receiver/ChargingProfiles/chargingProfileResponse.schema.json', static fn($data) => ChargingProfileResponseFactory::fromJson($data));
    }
}
