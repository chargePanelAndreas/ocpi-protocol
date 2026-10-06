<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class Period implements JsonSerializable
{
    private DateTime $startDateTime;

    private DateTime $endDateTime;

    public function __construct(
        DateTime $startDateTime,
        DateTime $endDateTime
    )
    {
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }

    public function getStartDateTime(): DateTime
    {
        return $this->startDateTime;
    }

    public function getEndDateTime(): DateTime
    {
        return $this->endDateTime;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'start_date_time' => DateTimeFormatter::format($this->startDateTime),
            'end_date_time' => DateTimeFormatter::format($this->endDateTime),
        ];


        return $return;
    }
}
