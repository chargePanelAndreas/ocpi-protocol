<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\PartialTerminal;
use stdClass;

class PartialTerminalFactory
{
    public static function fromJson(?stdClass $json): ?PartialTerminal
    {
        if ($json === null) {
            return null;
        }

        $object = new PartialTerminal();

        if (property_exists($json, 'location_ids')) {
            $items = [];
            foreach ($json->location_ids ?? [] as $item) {
                $items[] = $item;
            }
            $object->withLocationIds($items);
        }
        if (property_exists($json, 'evse_uids')) {
            $items = [];
            foreach ($json->evse_uids ?? [] as $item) {
                $items[] = $item;
            }
            $object->withEvseUids($items);
        }

        return $object;
    }
}
