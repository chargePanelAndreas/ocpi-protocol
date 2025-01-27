<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Put;

use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\LocationFactory;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Location;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\LocationRequestParams;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\LocationUpdateRequest;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

class ReceiverLocationPutRequest extends LocationUpdateRequest
{
    private Location $location;

    public function __construct(ServerRequestInterface $request, LocationRequestParams $params)
    {
        parent::__construct($request, $params);
        PayloadValidation::coerce('V2_2_1/Receiver/Locations/locationPutRequest.schema.json', $this->jsonBody);
        $location = LocationFactory::fromJson($this->jsonBody);
        if ($location === null) {
            throw new UnexpectedValueException('Location cannot be null');
        }
        $this->location = $location;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }
}
