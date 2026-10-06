<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Payments;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\FinancialAdviceConfirmationFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\FinancialAdviceConfirmation;
use Chargemap\OCPI\Versions\V2_3_0\Server\Generic\BodyRequest;
use Psr\Http\Message\ServerRequestInterface;

class ReceiverFinancialAdviceConfirmationPostRequest extends BodyRequest
{
    public function __construct(ServerRequestInterface $request)
    {
        parent::__construct($request, 'V2_3_0/Receiver/Payments/financialAdviceConfirmationPostRequest.schema.json', static fn($json) => FinancialAdviceConfirmationFactory::fromJson($json), []);
    }

    public function getFinancialAdviceConfirmation(): FinancialAdviceConfirmation
    {
        return $this->model();
    }
}
