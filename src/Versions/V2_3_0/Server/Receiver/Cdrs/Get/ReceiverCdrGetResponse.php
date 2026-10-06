<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Cdrs\Get;

use Chargemap\OCPI\Common\Server\OcpiSuccessResponse;
use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Cdr;

class ReceiverCdrGetResponse extends OcpiSuccessResponse
{
    private Cdr $cdr;

    public function __construct(Cdr $cdr, string $statusMessage = null)
    {
        parent::__construct(OcpiSuccessHttpCode::HTTP_OK(), $statusMessage);
        $this->cdr = $cdr;
    }

    protected function getData(): Cdr
    {
        return $this->cdr;
    }
}
