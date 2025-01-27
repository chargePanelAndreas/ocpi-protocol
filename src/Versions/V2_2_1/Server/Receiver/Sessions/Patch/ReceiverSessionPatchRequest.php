<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Sessions\Patch;

use Chargemap\OCPI\Common\Utils\PayloadValidation;
use Chargemap\OCPI\Versions\V2_2_1\Common\Factories\PartialSessionFactory;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\PartialSession;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Locations\Patch\UnsupportedPatchException;
use Chargemap\OCPI\Versions\V2_2_1\Server\Receiver\Sessions\OcpiSessionUpdateRequest;
use Psr\Http\Message\ServerRequestInterface;
use UnexpectedValueException;

class ReceiverSessionPatchRequest extends OcpiSessionUpdateRequest
{
    private PartialSession $partialSession;

    public function __construct(ServerRequestInterface $request, string $countryCode, string $partyId, string $sessionId)
    {
        parent::__construct($request, $countryCode, $partyId, $sessionId);
        PayloadValidation::coerce('V2_2_1/Receiver/Sessions/sessionPatchRequest.schema.json', $this->jsonBody);

        $partialSession = PartialSessionFactory::fromJson($this->jsonBody);
        if ($partialSession === null) {
            throw new UnexpectedValueException('PartialSession cannot be null');
        }

        if ($partialSession->hasId() && $partialSession->getId() !== $sessionId) {
            throw new UnsupportedPatchException('Property id can not be patched at the moment');
        }

        $this->partialSession = $partialSession;
    }

    public function getPartialSession(): PartialSession
    {
        return $this->partialSession;
    }
}
