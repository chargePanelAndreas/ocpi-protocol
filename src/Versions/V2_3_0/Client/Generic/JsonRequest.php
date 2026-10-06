<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Generic;

use Chargemap\OCPI\Common\Client\Modules\AbstractRequest;
use Chargemap\OCPI\Common\Client\Modules\ListingRequest;
use Chargemap\OCPI\Versions\V2_3_0\Client\VersionTrait;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ModuleId;
use Http\Discovery\Psr17FactoryDiscovery;
use JsonSerializable;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Generic OCPI 2.3.0 request used by the bookings, payments, chargingprofiles and hubclientinfo modules.
 */
class JsonRequest extends AbstractRequest
{
    use VersionTrait;
    use ListingRequest;

    private ModuleId $module;
    private string $method;
    private string $path;
    /** @var JsonSerializable|array|null */
    private $body;
    private array $query;

    /**
     * @param JsonSerializable|array|null $body
     */
    public function __construct(ModuleId $module, string $method, string $path = '', $body = null, array $query = [])
    {
        $this->module = $module;
        $this->method = $method;
        $this->path = $path;
        $this->body = $body;
        $this->query = array_filter($query, static fn($value) => $value !== null);
    }

    public function getModule(): ModuleId
    {
        return $this->module;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getServerRequestInterface(ServerRequestFactoryInterface $serverRequestFactory, ?StreamFactoryInterface $streamFactory): ServerRequestInterface
    {
        $query = $this->query;
        if (isset($this->offset)) {
            $query['offset'] = $this->offset;
        }
        if (isset($this->limit)) {
            $query['limit'] = $this->limit;
        }

        $uri = $this->path . (empty($query) ? '' : '?' . http_build_query($query));
        $request = $serverRequestFactory->createServerRequest($this->method, $uri === '' ? '/' : $uri);

        if ($this->body !== null) {
            $streamFactory = $streamFactory ?? Psr17FactoryDiscovery::findStreamFactory();
            $request = $request
                ->withHeader('Content-Type', 'application/json')
                ->withBody($streamFactory->createStream(json_encode($this->body)));
        }

        return $request;
    }
}

