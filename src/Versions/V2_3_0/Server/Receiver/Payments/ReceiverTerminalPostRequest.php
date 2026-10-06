<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverTerminalPostRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request, 'V2_3_0/Receiver/Payments/terminalPostRequest.schema.json', static fn($json) => TerminalFactory::fromJson($json), []);
    }

    public function getTerminal(): Terminal
    {
        return $this->model();
    }
}
