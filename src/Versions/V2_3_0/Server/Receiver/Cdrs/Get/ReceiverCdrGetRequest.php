<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Cdrs\Get;

use Chargemap\OCPI\Common\Server\OcpiBaseRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverCdrGetRequest extends OcpiBaseRequest
{
    private string $cdrId;

    public function __construct(ServerRequestInterface $request, string $cdrId)
    {
        parent::__construct($request);
        $this->cdrId = $cdrId;
    }

    public function getCdrId(): string
    {
        return $this->cdrId;
    }
}
