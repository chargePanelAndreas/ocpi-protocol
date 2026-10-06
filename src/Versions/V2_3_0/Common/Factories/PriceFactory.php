<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Price;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TaxAmount;
use stdClass;

class PriceFactory
{
    public static function fromJson(?stdClass $json): ?Price
    {
        if ($json === null) {
            return null;
        }

        $price = new Price($json->before_taxes);

        foreach ($json->taxes ?? [] as $jsonTax) {
            $price->addTax(new TaxAmount(
                $jsonTax->name,
                $jsonTax->account_number ?? null,
                $jsonTax->percentage ?? null,
                $jsonTax->amount
            ));
        }

        return $price;
    }
}

