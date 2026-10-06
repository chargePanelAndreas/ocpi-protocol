<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class Price implements JsonSerializable
{
    private float $beforeTaxes;

    /** @var TaxAmount[] */
    private array $taxes = [];

    public function __construct(float $beforeTaxes)
    {
        $this->beforeTaxes = $beforeTaxes;
    }

    public function addTax(TaxAmount $tax): self
    {
        $this->taxes[] = $tax;

        return $this;
    }

    public function getBeforeTaxes(): float
    {
        return $this->beforeTaxes;
    }

    /**
     * @return TaxAmount[]
     */
    public function getTaxes(): array
    {
        return $this->taxes;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'before_taxes' => $this->beforeTaxes,
        ];

        if (count($this->taxes) > 0) {
            $return['taxes'] = $this->taxes;
        }

        return $return;
    }
}

