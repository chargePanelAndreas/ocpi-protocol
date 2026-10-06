<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\TerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Terminal;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderTerminalPutRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $terminalId)
    {
        parent::__construct($request, 'V2_3_0/Sender/Payments/terminalPutRequest.schema.json', static fn($json) => TerminalFactory::fromJson($json), ['terminalId' => $terminalId]);
    }

    public function getTerminal(): Terminal
    {
        return $this->model();
    }

    public function getTerminalId(): string
    {
        return $this->getParam('terminalId');
    }
}
