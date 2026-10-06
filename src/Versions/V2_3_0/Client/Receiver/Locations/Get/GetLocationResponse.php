<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver\Locations\Get;

use Chargemap\OCPI\Common\Client\Modules\AbstractResponse;
use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\LocationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Location;
use Psr\Http\Message\ResponseInterface;

class GetLocationResponse extends AbstractResponse
{
    private Location $location;

    private function __construct(Location $location)
    {
        $this->location = $location;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    /**
     * @throws OcpiInvalidPayloadClientError
     */
    public static function from(ResponseInterface $response): GetLocationResponse
    {
        $json = self::toJson($response, 'V2_3_0/Receiver/Locations/locationGetResponse.schema.json');

        $location = LocationFactory::fromJson($json->data);

        return new self($location);
    }
}
