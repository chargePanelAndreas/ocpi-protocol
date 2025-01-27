<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_1_1\Server\Common\Credentials\Post;

use Chargemap\OCPI\Common\Server\OcpiCreateResponse;
use Chargemap\OCPI\Versions\V2_1_1\Common\Models\Credentials;

class OcpiCredentialsPostResponse extends OcpiCreateResponse
{
    private Credentials $credentials;

    public function __construct(Credentials $credentials, string $statusMessage = null)
    {
        parent::__construct($statusMessage);
        $this->credentials = $credentials;
    }

    protected function getData(): Credentials
    {
        return $this->credentials;
    }
}
