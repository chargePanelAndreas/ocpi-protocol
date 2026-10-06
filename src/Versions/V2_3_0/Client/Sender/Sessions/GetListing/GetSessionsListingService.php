<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Sender\Sessions\GetListing;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;

class GetSessionsListingService extends AbstractFeatures
{
    /**
     * @param GetSessionsListingRequest $request
     * @return GetSessionsListingResponse
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     */
    public function handle(GetSessionsListingRequest $request): GetSessionsListingResponse
    {
        $responseInterface = $this->sendRequest($request);
        return GetSessionsListingResponse::from($request, $responseInterface);
    }
}
