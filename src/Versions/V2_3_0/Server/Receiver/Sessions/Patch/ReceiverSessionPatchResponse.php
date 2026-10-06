<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Sessions\Patch;

use Chargemap\OCPI\Common\Server\OcpiUpdateResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialSession;

class ReceiverSessionPatchResponse extends OcpiUpdateResponse
{
    private PartialSession $session;

    public function __construct(PartialSession $session, string $statusMessage = 'Session successfully updated')
    {
        parent::__construct($statusMessage);
        $this->session = $session;
    }

    protected function getData()
    {
        return null;
    }
}
