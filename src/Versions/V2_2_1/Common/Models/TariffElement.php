<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use JsonSerializable;

class TariffElement implements JsonSerializable
{
    /** @var PriceComponent[] */
    private array $priceComponents = [];

    private ?TariffRestrictions $restrictions;

    public function __construct(?TariffRestrictions $restrictions)
    {
        $this->restrictions = $restrictions;
    }

    public function addPriceComponent(PriceComponent $component): self
    {
        $this->priceComponents[] = $component;

        return $this;
    }

    /**
     * @return PriceComponent[]
     */
    public function getPriceComponents(): array
    {
        return $this->priceComponents;
    }

    public function getRestrictions(): ?TariffRestrictions
    {
        return $this->restrictions;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'price_components' => $this->priceComponents,
        ];

        if ($this->restrictions !== null) {
            $return['restrictions'] = $this->restrictions;
        }

        return $return;
    }
}