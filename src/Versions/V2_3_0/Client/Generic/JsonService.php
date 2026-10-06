<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Generic;

use Chargemap\OCPI\Common\Client\Modules\AbstractFeatures;

class JsonService extends AbstractFeatures
{
    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function status(JsonRequest $request): JsonResponse
    {
        return JsonResponse::fromStatus($this->sendRequest($request));
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function object(JsonRequest $request, string $schema, callable $factory): JsonResponse
    {
        return JsonResponse::fromObject($this->sendRequest($request), $schema, $factory);
    }

    /**
     * @throws \Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Client\OcpiUnauthorizedException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function listing(JsonRequest $request, string $schema, ?string $itemSchema, callable $factory): JsonResponse
    {
        return JsonResponse::fromListing($request, $this->sendRequest($request), $schema, $itemSchema, $factory);
    }
}

