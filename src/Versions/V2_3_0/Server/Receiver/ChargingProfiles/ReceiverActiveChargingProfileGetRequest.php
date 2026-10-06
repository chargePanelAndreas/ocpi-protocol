<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\ChargingProfiles;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverActiveChargingProfileGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $sessionId)
    {
        parent::__construct($request, ['sessionId' => $sessionId]);
    }

    public function getSessionId(): string
    {
        return $this->getParam('sessionId');
    }

    public function getDuration(): ?int
    {
        $value = $this->getRawRequest()->getQueryParams()['duration'] ?? null;
        return $value === null ? null : (int)$value;
    }

    public function getResponseUrl(): ?string
    {
        $value = $this->getRawRequest()->getQueryParams()['response_url'] ?? null;
        return $value === null ? null : (string)$value;
    }
}
