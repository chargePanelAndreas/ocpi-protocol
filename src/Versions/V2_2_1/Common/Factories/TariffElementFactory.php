<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Factories;

use Chargemap\OCPI\Versions\V2_2_1\Common\Models\PriceComponent;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\TariffDimensionType;
use Chargemap\OCPI\Versions\V2_2_1\Common\Models\TariffElement;
use stdClass;

class TariffElementFactory
{
    public static function fromJson(?stdClass $json): ?TariffElement
    {
        if ($json === null) {
            return null;
        }

        $restrictions = ($json->restrictions ?? null) instanceof stdClass ? $json->restrictions : null;
        $tariffElement = new TariffElement(TariffRestrictionsFactory::fromJson($restrictions));

        foreach ($json->price_components as $jsonPriceComponent) {
            $tariffElement->addPriceComponent(
                new PriceComponent(
                    new TariffDimensionType($jsonPriceComponent->type),
                    $jsonPriceComponent->price,
                    $jsonPriceComponent->vat ?? null,
                    $jsonPriceComponent->step_size
                )
            );
        }

        return $tariffElement;
    }
}
