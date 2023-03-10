<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Client\Receiver\Locations\Evses\Connectors\Get;

use Chargemap\OCPI\Common\Client\Modules\Locations\Get\GetLocationResponse as BaseResponse;
use Chargemap\OCPI\Common\Client\OcpiUnauthorizedException;
use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError;
use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\ConnectorFactory;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Connector;
use Psr\Http\Message\ResponseInterface;

class GetConnectorResponse extends BaseResponse
{
    private ?Connector $connector = null;

    /**
     * @param ResponseInterface $response
     * @return static
     * @throws OcpiUnauthorizedException
     * @throws OcpiInvalidPayloadClientError
     */
    public static function from(ResponseInterface $response): self
    {
        if ($response->getStatusCode() === 401) {
            throw new OcpiUnauthorizedException();
        }
        $return = new self();
        if ($response->getStatusCode() === 404 || $response->getBody()->__toString() === "") {
            return $return;
        }
        $json = self::toJson($response, 'V2_2_1/Receiver/Locations/Evses/Connectors/connectorGetResponse.schema.json');
        if (empty($json->data)) {
            return $return;
        }
        $return->connector = ConnectorFactory::fromJson($json->data);

        return $return;
    }

    public function getConnector(): ?Connector
    {
        return $this->connector;
    }
}
