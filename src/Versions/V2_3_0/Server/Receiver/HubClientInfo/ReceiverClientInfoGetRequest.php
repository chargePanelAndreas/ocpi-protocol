<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\HubClientInfo;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverClientInfoGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId)
    {
        parent::__construct($request, ['countryCode' => $countryCode, 'partyId' => $partyId]);
    }

    public function getCountryCode(): string
    {
        return $this->getParam('countryCode');
    }

    public function getPartyId(): string
    {
        return $this->getParam('partyId');
    }
}
