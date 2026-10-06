<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\PartialTerminalFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialTerminal;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderTerminalPatchRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request, string $terminalId)
    {
        parent::__construct($request, 'V2_3_0/Sender/Payments/terminalPatchRequest.schema.json', static fn($json) => PartialTerminalFactory::fromJson($json), ['terminalId' => $terminalId]);
    }

    public function getTerminal(): PartialTerminal
    {
        return $this->model();
    }

    public function getTerminalId(): string
    {
        return $this->getParam('terminalId');
    }
}
