<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Common\Client;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;
use Chargemap\OCPI\Common\Client\Modules\AbstractRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Cdrs\GetListing\GetCdrsListingRequest as V2_1_1_GetCdrsListingRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Cdrs\GetListing\GetCdrsListingService as V2_1_1_GetCdrsListingService;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Locations\Get\GetLocationRequest as V2_1_1_GetLocationRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Locations\Get\GetLocationService as V2_1_1_GetLocationService;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Locations\GetListing\GetLocationsListingRequest as V2_1_1_GetLocationsListingRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Locations\GetListing\GetLocationsListingService as V2_1_1_GetLocationsListingService;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Get\GetTokenRequest as V2_1_1_GetTokenRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Get\GetTokenService as V2_1_1_GetTokenService;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Patch\PatchTokenRequest as V2_1_1_PatchTokenRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Patch\PatchTokenService as V2_1_1_PatchTokenService;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Put\PutTokenRequest as V2_1_1_PutTokenRequest;
use Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Put\PutTokenService as V2_1_1_PutTokenService;
use UnexpectedValueException;

final class ServiceFactory
{
    public static function from(AbstractRequest $request, OcpiConfiguration $configuration): AbstractFeatures
    {
        switch ($request->getVersion()->getValue()) {
            case OcpiVersion::V2_1_1:
                if (get_class($request) === V2_1_1_GetCdrsListingRequest::class) {
                    return new V2_1_1_GetCdrsListingService($configuration);
                }
                if (get_class($request) === V2_1_1_GetLocationRequest::class) {
                    return new V2_1_1_GetLocationService($configuration);
                }
                if (get_class($request) === V2_1_1_GetLocationsListingRequest::class) {
                    return new V2_1_1_GetLocationsListingService($configuration);
                }
                if (get_class($request) === V2_1_1_GetTokenRequest::class) {
                    return new V2_1_1_GetTokenService($configuration);
                }
                if (get_class($request) === V2_1_1_PatchTokenRequest::class) {
                    return new V2_1_1_PatchTokenService($configuration);
                }
                if (get_class($request) === V2_1_1_PutTokenRequest::class) {
                    return new V2_1_1_PutTokenService($configuration);
                }
                break;
        }

        throw new UnexpectedValueException(sprintf('Could not find service to handle %s class request', get_class($request)));
    }
}
