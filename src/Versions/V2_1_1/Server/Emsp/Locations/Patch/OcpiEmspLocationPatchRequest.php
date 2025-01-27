<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_1_1\Server\Emsp\Locations\Patch;

use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Chargemap\OCPI\Versions\V2_1_1\Common\Factories\PartialLocationFactory;
use Chargemap\OCPI\Versions\V2_1_1\Common\Models\PartialLocation;
use Chargemap\OCPI\Versions\V2_1_1\Server\Emsp\Locations\LocationRequestParams;
use Chargemap\OCPI\Versions\V2_1_1\Server\Emsp\Locations\OcpiLocationUpdateRequest;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

class OcpiEmspLocationPatchRequest extends OcpiLocationUpdateRequest
{
    private PartialLocation $partialLocation;

    public function __construct(ServerRequestInterface $request, LocationRequestParams $params)
    {
        parent::__construct($request, $params);
        PayloadValidation::coerce('V2_1_1/eMSP/Locations/locationPatchRequest.schema.json', $this->jsonBody);
        $partialLocation = PartialLocationFactory::fromJson($this->jsonBody);
        if ($partialLocation === null) {
            throw new UnexpectedValueException('PartialLocation cannot be null');
        }

        if($partialLocation->hasId() && $partialLocation->getId() !== $params->getLocationId()) {
            throw new UnsupportedPatchException( 'Property id can not be patched at the moment' );
        }

        $this->partialLocation = $partialLocation;
    }

    public function getPartialLocation(): PartialLocation
    {
        return $this->partialLocation;
    }
}
