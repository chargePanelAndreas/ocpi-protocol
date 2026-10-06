<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Tokens\Get;

use Chargemap\OCPI\Common\Server\OcpiSuccessResponse;
use Chargemap\OCPI\Common\Server\StatusCodes\OcpiSuccessHttpCode;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Token;

class ReceiverTokenGetResponse extends OcpiSuccessResponse
{
    private Token $token;

    public function __construct(Token $token, string $statusMessage = null)
    {
        parent::__construct(OcpiSuccessHttpCode::HTTP_OK(), $statusMessage);
        $this->token = $token;
    }

    protected function getData(): Token
    {
        return $this->token;
    }
}
