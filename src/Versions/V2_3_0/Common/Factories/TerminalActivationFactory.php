<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\TerminalActivation;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\InvoiceCreator;
use DateTime;
use stdClass;

class TerminalActivationFactory
{
    /**
     * @param stdClass[]|null $json
     * @return TerminalActivation[]|null
     */
    public static function arrayFromJsonArray(?array $json): ?array
    {
        if ($json === null) {
            return null;
        }

        $objects = [];
        foreach ($json as $jsonObject) {
            $objects[] = self::fromJson($jsonObject);
        }

        return $objects;
    }

    public static function fromJson(?stdClass $json): ?TerminalActivation
    {
        if ($json === null) {
            return null;
        }

        $object = new TerminalActivation(
            new DateTime($json->last_updated),
            $json->terminal_id ?? null,
            $json->customer_reference ?? null,
            $json->party_id ?? null,
            $json->country_code ?? null,
            $json->address ?? null,
            $json->city ?? null,
            $json->postal_code ?? null,
            $json->state ?? null,
            $json->country ?? null,
            GeoLocationFactory::fromJson($json->coordinates ?? null),
            $json->invoice_base_url ?? null,
            isset($json->invoice_creator) ? new InvoiceCreator($json->invoice_creator) : null,
            $json->reference ?? null
        );

        foreach ($json->location_ids ?? [] as $item) {
            $object->addLocationId($item);
        }

        foreach ($json->evse_uids ?? [] as $item) {
            $object->addEvseUid($item);
        }

        return $object;
    }
}
