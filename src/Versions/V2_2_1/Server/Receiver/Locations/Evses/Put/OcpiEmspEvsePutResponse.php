<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Put;

use Chargemap\OCPI\Common\Server\OcpiCreateResponse;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\EVSE;

class OcpiEmspEvsePutResponse extends OcpiCreateResponse
{
    private EVSE $evse;

    public function __construct(EVSE $evse, string $statusMessage = 'EVSE successfully created.')
    {
        parent::__construct($statusMessage);
        $this->evse = $evse;
    }

    protected function getData()
    {
        return null;
    }
}
