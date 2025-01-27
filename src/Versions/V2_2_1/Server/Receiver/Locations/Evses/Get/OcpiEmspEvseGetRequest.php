<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Evses\Get;

use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Get\ReceiverLocationGetRequest;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\LocationRequestParams;
use InvalidArgumentException;
use Psr\Http\Message\ServerRequestInterface;

class OcpiEmspEvseGetRequest extends ReceiverLocationGetRequest
{
    protected string $evseUid;

    public function __construct(ServerRequestInterface $request, LocationRequestParams $params)
    {
        parent::__construct($request, $params);
        $evseUid = $params->getEvseUid();
        if ($evseUid === null) {
            throw new InvalidArgumentException('EVSE UID should be provided.');
        }
        $this->evseUid = $evseUid;
    }

    public function getEvseUid(): string
    {
        return $this->evseUid;
    }
}
