<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Client\Receiver\Locations\Put;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;

class PutLocationService extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function handle(PutLocationRequest $request): PutLocationResponse
    {
        $responseInterface = $this->sendRequest($request);
        return new PutLocationResponse($responseInterface);
    }
}
