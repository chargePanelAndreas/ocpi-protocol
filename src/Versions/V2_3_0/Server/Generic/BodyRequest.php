<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Generic;

use Chargemap\OCPI\Common\Server\OcpiUpdateRequest;
use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

/**
 * Request with a JSON body (PUT / PATCH / POST). The body is validated against the given schema.
 */
class BodyRequest extends OcpiUpdateRequest
{
    /** @var array<string,string> */
    private array $params;

    /** @var mixed */
    private $model;

    /**
     * @param array<string,string> $params path parameters by name
     * @param callable $factory builds the model from the decoded body
     */
    public function __construct(ServerRequestInterface $request, string $schema, callable $factory, array $params = [])
    {
        parent::__construct($request);
        $this->params = ParamValidator::validate($params);
        PayloadValidation::coerce($schema, $this->jsonBody);
        $this->model = $factory($this->jsonBody);
        if ($this->model === null) {
            throw new UnexpectedValueException('Payload cannot be null');
        }
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

    /**
     * @return mixed
     */
    protected function model()
    {
        return $this->model;
    }
}

