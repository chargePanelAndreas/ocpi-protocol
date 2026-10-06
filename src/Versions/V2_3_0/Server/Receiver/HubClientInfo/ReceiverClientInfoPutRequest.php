<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\HubClientInfo;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ClientInfoFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ClientInfo;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverClientInfoPutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId)
    {
        parent::__construct($request, 'V2_3_0/Receiver/HubClientInfo/clientInfoPutRequest.schema.json', static fn($json) => ClientInfoFactory::fromJson($json), ['countryCode' => $countryCode, 'partyId' => $partyId]);
    }

    public function getClientInfo(): ClientInfo
    {
        return $this->model();
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
