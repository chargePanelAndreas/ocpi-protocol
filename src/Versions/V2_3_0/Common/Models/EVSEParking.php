<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class EVSEParking implements JsonSerializable
{
    private string $parkingId;

    private ?EVSEPosition $evsePosition;

    public function __construct(
        string $parkingId,
        ?EVSEPosition $evsePosition
    )
    {
        $this->parkingId = $parkingId;
        $this->evsePosition = $evsePosition;
    }

    public function getParkingId(): string
    {
        return $this->parkingId;
    }

    public function getEvsePosition(): ?EVSEPosition
    {
        return $this->evsePosition;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'parking_id' => $this->parkingId,
        ];

        if ($this->evsePosition !== null) {
            $return['evse_position'] = $this->evsePosition;
        }

        return $return;
    }
}
