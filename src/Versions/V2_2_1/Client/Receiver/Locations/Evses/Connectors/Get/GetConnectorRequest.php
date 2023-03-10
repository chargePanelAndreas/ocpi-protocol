<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Client\Receiver\Locations\Evses\Connectors\Get;

use Chargemap\OCPI\Common\Client\Modules\Locations\Get\GetLocationRequest as BaseRequest;
use Chargemap\OCPI\Versions\V2_2_1\Client\VersionTrait;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\ModuleId;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class GetConnectorRequest extends BaseRequest
{
    use VersionTrait;

    private string $countryCode;
    private string $partyId;
    private string $locationId;
    private string $evseUid;
    private string $connectorId;

    public function __construct(string $countryCode, string $partyId, string $locationId, string $evseUid, string $connectorId)
    {
        if (strlen($countryCode) !== 2) {
            throw new InvalidArgumentException("Length of countryCode must be 2");
        }

        if (strlen($partyId) !== 3) {
            throw new InvalidArgumentException("Length of partyId must be 3");
        }

        if (strlen($locationId) > 36 || empty($locationId)) {
            throw new InvalidArgumentException('Length of locationId must be between 1 and 36');
        }

        if (strlen($evseUid) > 36 || empty($evseUid)) {
            throw new InvalidArgumentException("Length of evseUid must be between 1 and 36");
        }

        $this->partyId = $partyId;
        $this->countryCode = $countryCode;
        $this->locationId = $locationId;
        $this->evseUid = $evseUid;
        $this->connectorId = $connectorId;
    }

    public function getModule(): ModuleId
    {
        return ModuleId::LOCATIONS();
    }

    public function getLocationId(): string
    {
        return $this->locationId;
    }

    public function getServerRequestInterface(
        ServerRequestFactoryInterface $serverRequestFactory,
        ?StreamFactoryInterface $streamFactory
    ): ServerRequestInterface {
        return $serverRequestFactory->createServerRequest('GET',
        '/' . $this->countryCode . '/' . $this->partyId . '/' . $this->locationId . '/' . $this->evseUid . '/' . $this->connectorId);
    }
}
