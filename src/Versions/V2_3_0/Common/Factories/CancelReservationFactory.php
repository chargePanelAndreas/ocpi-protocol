<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CancelReservation;
use stdClass;

class CancelReservationFactory
{
    public static function fromJson(?stdClass $json): ?CancelReservation
    {
        if ($json === null) {
            return null;
        }

        return new CancelReservation(
            $json->response_url,
            $json->reservation_id
        );
    }
}
