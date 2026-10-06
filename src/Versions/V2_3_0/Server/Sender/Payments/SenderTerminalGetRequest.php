<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Sender\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class SenderTerminalGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $terminalId)
    {
        parent::__construct($request, ['terminalId' => $terminalId]);
    }

    public function getTerminalId(): string
    {
        return $this->getParam('terminalId');
    }
}
