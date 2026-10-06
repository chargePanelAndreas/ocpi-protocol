<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class PriceLimit implements JsonSerializable
{
    private float $beforeTaxes;

    private ?float $afterTaxes;

    public function __construct(float $beforeTaxes, ?float $afterTaxes)
    {
        $this->beforeTaxes = $beforeTaxes;
        $this->afterTaxes = $afterTaxes;
    }

    public function getBeforeTaxes(): float
    {
        return $this->beforeTaxes;
    }

    public function getAfterTaxes(): ?float
    {
        return $this->afterTaxes;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'before_taxes' => $this->beforeTaxes,
        ];

        if ($this->afterTaxes !== null) {
            $return['after_taxes'] = $this->afterTaxes;
        }

        return $return;
    }
}

