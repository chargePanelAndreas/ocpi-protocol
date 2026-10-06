<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\ChargingProfiles;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\SetChargingProfileFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\SetChargingProfile;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverChargingProfilePutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $sessionId)
    {
        parent::__construct($request, 'V2_3_0/Receiver/ChargingProfiles/setChargingProfilePutRequest.schema.json', static fn($json) => SetChargingProfileFactory::fromJson($json), ['sessionId' => $sessionId]);
    }

    public function getSetChargingProfile(): SetChargingProfile
    {
        return $this->model();
    }

    public function getSessionId(): string
    {
        return $this->getParam('sessionId');
    }
}
