<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class Cancellation implements JsonSerializable
{
    private CanceledReason $cancellationReason;

    private Role $whoCanceled;

    public function __construct(
        CanceledReason $cancellationReason,
        Role $whoCanceled
    )
    {
        $this->cancellationReason = $cancellationReason;
        $this->whoCanceled = $whoCanceled;
    }

    public function getCancellationReason(): CanceledReason
    {
        return $this->cancellationReason;
    }

    public function getWhoCanceled(): Role
    {
        return $this->whoCanceled;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'cancellation_reason' => $this->cancellationReason,
            'who_canceled' => $this->whoCanceled,
        ];


        return $return;
    }
}
