<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Client\Receiver\Tokens\Put;

use Chargemap\OCPI\Common\Client\Modules\Tokens\Put\PutTokenResponse as BaseResponse;
use Psr\Http\Message\ResponseInterface;

class PutTokenResponse extends BaseResponse
{
    private ResponseInterface $responseInterface;

    public function __construct(ResponseInterface $response)
    {
        self::checkStatusCode($response);
        $this->responseInterface = $response;
    }

    public function getResponseInterface(): ResponseInterface
    {
        return $this->responseInterface;
    }
}
