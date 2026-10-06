<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Tariff;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TaxIncluded;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TariffType;
use DateTime;
use stdClass;

class TariffFactory
{
    /**
     * @param stdClass[]|null $json
     * @return Tariff[]
     */
    public static function arrayFromJsonArray(?array $json): ?array
    {
        if ($json === null) {
            return null;
        }

        $tariffs = [];

        foreach ($json as $jsonTariff) {
            $tariffs[] = self::fromJson($jsonTariff);
        }

        return $tariffs;
    }

    public static function fromJson(?stdClass $json): ?Tariff
    {
        if ($json === null) {
            return null;
        }

        $tariff = new Tariff(
            $json->country_code,
            $json->party_id,
            $json->id,
            $json->currency,
            isset($json->type) ? new TariffType($json->type) : null,
            $json->tariff_alt_url ?? null,
            PriceLimitFactory::fromJson($json->min_price ?? null),
            PriceLimitFactory::fromJson($json->max_price ?? null),
            $json->preauthorize_amount ?? null,
            new TaxIncluded($json->tax_included),
            isset($json->start_date_time) ? new DateTime($json->start_date_time) : null,
            isset($json->end_date_time) ? new DateTime($json->end_date_time) : null,
            EnergyMixFactory::fromJson($json->energy_mix ?? null),
            new DateTime($json->last_updated)
        );

        if (property_exists($json, 'tariff_alt_text') && $json->tariff_alt_text !== null) {
            foreach ((array)DisplayTextFactory::arrayFromJsonArray($json->tariff_alt_text) as $displayText) {
                $tariff->addTariffAltText($displayText);
            }
        }

        foreach ($json->elements as $jsonTariffElement) {
            $tariff->addTariffElement(TariffElementFactory::fromJson($jsonTariffElement));
        }

        return $tariff;
    }
}
