<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver\Cdrs\Get;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;

class GetCdrService extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function handle(GetCdrRequest $request): GetCdrResponse
    {
        $responseInterface = $this->sendRequest($request);
        return GetCdrResponse::from($responseInterface);
    }
}
