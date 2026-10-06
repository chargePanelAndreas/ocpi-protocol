<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Tariffs\Delete;

use Chargemap\OCPI\Common\Server\OcpiSuccessResponse;
use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;

class ReceiverTariffDeleteResponse extends OcpiSuccessResponse
{
    public function __construct(string $statusMessage = null)
    {
        parent::__construct(OcpiSuccessHttpCode::HTTP_OK(), $statusMessage);
    }

    protected function getData()
    {
        return null;
    }
}
