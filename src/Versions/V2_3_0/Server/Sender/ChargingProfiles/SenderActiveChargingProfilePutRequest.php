<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\ChargingProfiles;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\ActiveChargingProfileFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\ActiveChargingProfile;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderActiveChargingProfilePutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $sessionId)
    {
        parent::__construct($request, 'V2_3_0/Sender/ChargingProfiles/activeChargingProfilePutRequest.schema.json', static fn($json) => ActiveChargingProfileFactory::fromJson($json), ['sessionId' => $sessionId]);
    }

    public function getActiveChargingProfile(): ActiveChargingProfile
    {
        return $this->model();
    }

    public function getSessionId(): string
    {
        return $this->getParam('sessionId');
    }
}
