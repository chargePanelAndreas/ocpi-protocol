<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class TaxAmount implements JsonSerializable
{
    private string $name;

    private ?string $accountNumber;

    private ?float $percentage;

    private float $amount;

    public function __construct(string $name, ?string $accountNumber, ?float $percentage, float $amount)
    {
        $this->name = $name;
        $this->accountNumber = $accountNumber;
        $this->percentage = $percentage;
        $this->amount = $amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAccountNumber(): ?string
    {
        return $this->accountNumber;
    }

    public function getPercentage(): ?float
    {
        return $this->percentage;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'name' => $this->name,
            'amount' => $this->amount,
        ];

        if ($this->accountNumber !== null) {
            $return['account_number'] = $this->accountNumber;
        }

        if ($this->percentage !== null) {
            $return['percentage'] = $this->percentage;
        }

        return $return;
    }
}

