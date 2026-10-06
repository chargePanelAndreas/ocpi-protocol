<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver\Cdrs\Post;

use Chargemap\OCPI\Common\Client\Modules\AbstractResponse;
use Psr\Http\Message\ResponseInterface;

class PostCdrResponse extends AbstractResponse
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
