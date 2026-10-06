<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Generic;

use Chargemap\OCPI\Common\Client\Modules\AbstractResponse;
use Chargemap\OCPI\Common\Client\OcpiUnauthorizedException;
use Chargemap\OCPI\Common\Server\Errors\OcpiInvalidPayloadClientError;
use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Psr\Http\Message\ResponseInterface;

/**
 * Generic OCPI 2.3.0 response.
 * - for single objects use getData()
 * - for listings use getItems() / getNextRequest()
 * - for calls without payload use only the status check
 */
class JsonResponse extends AbstractResponse
{
    private ResponseInterface $responseInterface;

    /** @var mixed */
    private $data = null;

    /** @var array */
    private array $items = [];

    private ?JsonRequest $nextRequest = null;

    private function __construct(ResponseInterface $responseInterface)
    {
        $this->responseInterface = $responseInterface;
    }

    public function getResponseInterface(): ResponseInterface
    {
        return $this->responseInterface;
    }

    /**
     * Response without payload to be validated (PUT/PATCH/POST/DELETE returning only a status).
     * @throws OcpiInvalidPayloadClientError
     */
    public static function fromStatus(ResponseInterface $response): self
    {
        self::checkStatusCode($response);
        return new self($response);
    }

    /**
     * Response with a single object.
     * @param callable $factory receives the decoded `data` and returns a model
     * @throws OcpiInvalidPayloadClientError
     */
    public static function fromObject(ResponseInterface $response, string $schema, callable $factory): self
    {
        $json = self::toJson($response, $schema);
        $return = new self($response);
        $return->data = $factory($json->data);
        return $return;
    }

    /**
     * Response with a list of objects.
     * @param string|null $itemSchema when given invalid items are skipped
     * @throws OcpiUnauthorizedException
     * @throws OcpiInvalidPayloadClientError
     */
    public static function fromListing(JsonRequest $request, ResponseInterface $response, string $schema, ?string $itemSchema, callable $factory): self
    {
        if ($response->getStatusCode() === 401) {
            throw new OcpiUnauthorizedException();
        }

        $json = self::toJson($response, $schema);
        $return = new self($response);

        foreach ($json->data ?? [] as $item) {
            if ($itemSchema === null || PayloadValidation::isValidJson($itemSchema, $item)) {
                $return->items[] = $factory($item);
            }
        }

        $nextOffset = $request->getNextOffset($response);
        $nextLimit = $request->getNextLimit($response);

        if ($nextOffset !== null) {
            $next = (clone $request)->withOffset($nextOffset);
            if ($nextLimit !== null) {
                $next = $next->withLimit($nextLimit);
            }
            $return->nextRequest = $next;
        }

        return $return;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getNextRequest(): ?JsonRequest
    {
        return $this->nextRequest;
    }
}

