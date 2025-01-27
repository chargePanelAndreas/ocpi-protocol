<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Sessions\Put;

use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\SessionFactory;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\Session;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Sessions\OcpiSessionUpdateRequest;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

class ReceiverSessionPutRequest extends OcpiSessionUpdateRequest
{
    private Session $session;

    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $sessionId)
    {
        parent::__construct($request, $countryCode, $partyId, $sessionId);
        PayloadValidation::coerce('V2_2_1/Receiver/Sessions/sessionPutRequest.schema.json', $this->jsonBody);
        $session = SessionFactory::fromJson($this->jsonBody);
        if ($session === null) {
            throw new UnexpectedValueException('Session cannot be null');
        }
        $this->session = $session;
    }

    public function getSession(): Session
    {
        return $this->session;
    }
}
