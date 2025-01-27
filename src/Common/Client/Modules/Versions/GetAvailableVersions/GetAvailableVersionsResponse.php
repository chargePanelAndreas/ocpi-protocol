<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Common\Client\Modules\Versions\GetAvailableVersions;

use Chargemap\OCPI\Common\Client\Modules\AbstractResponse;
use Chargemap\OCPI\Common\Factories\VersionEndpointFactory;
use Chargemap\OCPI\Common\Models\VersionEndpoint;
use Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError;
use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidTokenClientError;
use Psr\Http\Message\ResponseInterface;

class GetAvailableVersionsResponse extends AbstractResponse
{
    /** @var VersionEndpoint[] */
    private array $versions = [];

    /**
     * @param ResponseInterface $response
     * @return static
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError
     * @throws \Chargemap\OCPI\Common\Server\Errors\OcpiInvalidTokenClientError
     */
    public static function fromResponseInterface(ResponseInterface $response): self
    {
        if($response->getStatusCode() === 404) {
            throw new OcpiGenericClientError('Url was not found');
        }

        if($response->getStatusCode() === 401) {
            //TODO reorganize namespace
            throw new OcpiInvalidTokenClientError();
        }

        $responseAsJson = self::toJson($response, 'Common/Versions/versionGetAvailableResponse.schema.json');

        if($responseAsJson->status_code === 2002) {
            //TODO reorganize namespace
            throw new OcpiInvalidTokenClientError();
        }

        $result = new self();

        foreach ($responseAsJson->data as $item) {
            $result->versions[] = VersionEndpointFactory::fromJson($item);
        }

        return $result;
    }

    /** @return VersionEndpoint[] */
    public function getVersions(): array
    {
        return $this->versions;
    }
}
