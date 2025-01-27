<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Get;

use Chargemap\OCPI\Common\Server\OcpiSuccessResponse;
use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Location;

class ReceiverLocationGetResponse extends OcpiSuccessResponse
{
    private Location $location;

    public function __construct(Location $location, string $statusMessage = null)
    {
        parent::__construct(OcpiSuccessHttpCode::HTTP_OK(), $statusMessage);
        $this->location = $location;
    }

    protected function getData(): Location
    {
        return $this->location;
    }
}
