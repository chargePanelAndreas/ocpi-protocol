<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\Errors\OcpiGenericClientError;
use Chargemap\OCPI\Common\Server\OcpiBaseRequest;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Request without body (GET / DELETE / POST without payload) identified by path parameters.
 */
class ParamsRequest extends OcpiBaseRequest
{
    /** @var array<string,string> */
    private array $params;

    /**
     * @param array<string,string> $params path parameters by name (countryCode and partyId get a length check)
     */
    public function __construct(ServerRequestInterface $request, array $params = [])
    {
        parent::__construct($request);
        $this->params = ParamValidator::validate($params);
    }

    /** @return array<string,string> */
    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $name): string
    {
        return $this->params[$name];
    }
}

