<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Client\Sender\Locations\GetListing;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;

class GetLocationsListingService extends AbstractFeatures
{
    /**
     * @param GetLocationsListingRequest $request
     * @return GetLocationsListingResponse
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     */
    public function handle(GetLocationsListingRequest $request): GetLocationsListingResponse
    {
        $responseInterface = $this->sendRequest($request);
        return GetLocationsListingResponse::from($request, $responseInterface);
    }
}
