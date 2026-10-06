<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\ParamsRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverFinancialAdviceConfirmationGetRequest extends ParamsRequest
{
    public function __construct(ServerRequestInterface $request, string $financialAdviceConfirmationId)
    {
        parent::__construct($request, ['financialAdviceConfirmationId' => $financialAdviceConfirmationId]);
    }

    public function getFinancialAdviceConfirmationId(): string
    {
        return $this->getParam('financialAdviceConfirmationId');
    }
}
