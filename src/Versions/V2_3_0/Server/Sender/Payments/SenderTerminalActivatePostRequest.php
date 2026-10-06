<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalActivationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TerminalActivation;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderTerminalActivatePostRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request, 'V2_3_0/Sender/Payments/terminalActivatePostRequest.schema.json', static fn($json) => TerminalActivationFactory::fromJson($json), []);
    }

    public function getTerminalActivation(): TerminalActivation
    {
        return $this->model();
    }
}
