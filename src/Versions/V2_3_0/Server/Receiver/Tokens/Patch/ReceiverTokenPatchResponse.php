<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Tokens\Patch;

use Chargemap\OCPI\Common\Server\OcpiUpdateResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialToken;

class ReceiverTokenPatchResponse extends OcpiUpdateResponse
{

    public function __construct(string $statusMessage = 'Token successfully updated')
    {
        parent::__construct($statusMessage);
    }

    protected function getData()
    {
        return null;
    }
}
