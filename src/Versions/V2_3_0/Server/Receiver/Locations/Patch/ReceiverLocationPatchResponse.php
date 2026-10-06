<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Locations\Patch;

use Chargemap\OCPI\Common\Server\OcpiUpdateResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialLocation;

class ReceiverLocationPatchResponse extends OcpiUpdateResponse
{
    private PartialLocation $partialLocation;

    public function __construct(PartialLocation $partialLocation, string $statusMessage = 'Location successfully updated.')
    {
        parent::__construct($statusMessage);
        $this->partialLocation = $partialLocation;
    }

    protected function getData()
    {
        return null;
    }
}
