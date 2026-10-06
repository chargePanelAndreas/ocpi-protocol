<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class Policy implements JsonSerializable
{
    private bool $reservationRequired;

    private ?float $adHoc;

    public function __construct(
        bool $reservationRequired,
        ?float $adHoc
    )
    {
        $this->reservationRequired = $reservationRequired;
        $this->adHoc = $adHoc;
    }

    public function getReservationRequired(): bool
    {
        return $this->reservationRequired;
    }

    public function getAdHoc(): ?float
    {
        return $this->adHoc;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'reservation_required' => $this->reservationRequired,
        ];

        if ($this->adHoc !== null) {
            $return['ad_hoc'] = $this->adHoc;
        }

        return $return;
    }
}
