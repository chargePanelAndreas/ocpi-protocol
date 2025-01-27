<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Common\Client\Modules;

use Chargemap\OCPI\Common\Client\OcpiConfiguration;
use Chargemap\OCPI\Common\Client\OcpiEndpointNotFoundException;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

class AbstractFeatures
{
    protected OcpiConfiguration $ocpiConfiguration;

    public function __construct(OcpiConfiguration $ocpiConfiguration)
    {
        $this->ocpiConfiguration = $ocpiConfiguration;
    }

    /**
     * @throws ClientExceptionInterface|OcpiEndpointNotFoundException
     */
    protected function sendRequest(AbstractRequest $request): ResponseInterface
    {
        $serverRequestInterface = $this->getServerRequestInterface($request);
        return $this->ocpiConfiguration->getHttpClient()->sendRequest($serverRequestInterface);
    }

    /**
     * @throws OcpiEndpointNotFoundException
     */
    private function getServerRequestInterface(AbstractRequest $request): ServerRequestInterface
    {
        $uriFactory = Psr17FactoryDiscovery::findUriFactory();

        $url = $this->ocpiConfiguration->getEndpoint($request->getModule(), $request->getVersion())->getUrl();

        $endpointUri = $uriFactory->createUri($url);

        $serverRequestInterface = $request->getServerRequestInterface($this->ocpiConfiguration->getServerRequestFactory(),
            $this->ocpiConfiguration->getStreamFactory());

        $uri = self::forgeUri($endpointUri, $serverRequestInterface->getUri());

        $serverRequestInterface = $this->addMessageIds($serverRequestInterface, $request);
        return $this->addAuthorization($serverRequestInterface->withUri($uri));
    }

    protected function addAuthorization(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request->withHeader('Authorization', 'Token ' . $this->ocpiConfiguration->getToken());
    }

    private static function forgeUri(UriInterface $baseUri, UriInterface $requestUri): UriInterface
    {
        $uri = $requestUri
            ->withPath($baseUri->getPath() . $requestUri->getPath())
            ->withScheme($baseUri->getScheme())
            ->withHost($baseUri->getHost());

        if (!empty($baseUri->getPort())) {
            $uri = $uri->withPort($baseUri->getPort());
        }

        if (!empty($baseUri->getUserInfo())) {
            $uri = $uri->withUserInfo($baseUri->getUserInfo());
        }

        return $uri;
    }

    protected function addMessageIds(ServerRequestInterface $serverRequestInterface, MessageIdInterface $request): ServerRequestInterface
    {
        return $serverRequestInterface
            ->withHeader('X-Request-ID', $request->getRequestId())
            ->withHeader('X-Correlation-ID', $request->getCorrelationId());
    }
}
