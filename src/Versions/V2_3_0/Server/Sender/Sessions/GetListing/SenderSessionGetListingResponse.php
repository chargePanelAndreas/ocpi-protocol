<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Sessions\GetListing;

use Chargemap\OCPI\Common\Server\OcpiListingResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Session;

class SenderSessionGetListingResponse extends OcpiListingResponse
{
    /** @var Session[] */
    private array $sessions = [];

    public function addSession(Session $session): self
    {
        $this->sessions[] = $session;
        return $this;
    }

    /**
     * @return Session[]
     */
    public function getData(): array
    {
        return $this->sessions;
    }
}
