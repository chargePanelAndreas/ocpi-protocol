<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_1_1\Client\Cpo\Tokens\Get;

use Chargemap\OCPI\Common\Client\Modules\Tokens\Get\GetTokenResponse as BaseResponse;
use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError;
use Chargemap\OCPI\Versions\V2_1_1\Common\Factories\TokenFactory;
use Chargemap\OCPI\Versions\V2_1_1\Common\Models\Token;
use Psr\Http\Message\ResponseInterface;

class GetTokenResponse extends BaseResponse
{
    private Token $token;

    private function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function getToken(): Token
    {
        return $this->token;
    }

    /**
     * @throws OcpiInvalidPayloadClientError
     */
    public static function from(ResponseInterface $response): GetTokenResponse
    {
        $json = self::toJson($response, 'V2_1_1/CPO/Tokens/tokenGetResponse.schema.json');

        $token = TokenFactory::fromJson($json->data);

        return new self($token);
    }
}
