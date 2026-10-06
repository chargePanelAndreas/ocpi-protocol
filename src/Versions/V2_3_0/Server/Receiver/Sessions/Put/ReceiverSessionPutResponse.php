<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Sessions\Put;

use Chargemap\OCPI\Common\Server\OcpiCreateResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Session;

class ReceiverSessionPutResponse extends OcpiCreateResponse
{
    private Session $session;

    public function __construct(Session $session, string $statusMessage = 'Session successfully created.')
    {
        parent::__construct($statusMessage);
        $this->session = $session;
    }

    protected function getData()
    {
        return null;
    }
}
