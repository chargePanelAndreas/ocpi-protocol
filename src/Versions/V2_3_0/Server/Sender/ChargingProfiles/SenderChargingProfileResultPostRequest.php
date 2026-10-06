<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\ChargingProfiles;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;
use stdClass;

class SenderChargingProfileResultPostRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request, 'V2_3_0/Sender/ChargingProfiles/chargingProfileResultPostRequest.schema.json', static fn($json) => $json, []);
    }

    public function getResult(): stdClass
    {
        return $this->model();
    }
}
