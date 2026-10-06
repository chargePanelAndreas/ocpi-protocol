<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use DateTime;
use JsonSerializable;

class Calendar implements JsonSerializable
{
    private string $id;

    private DateTime $beginFrom;

    private DateTime $endBefore;

    private ?int $timeslotIncrement;

    /** @var Timeslot[] */
    private array $availableTimeslots;

    private DateTime $lastUpdated;

    public function __construct(
        string $id,
        DateTime $beginFrom,
        DateTime $endBefore,
        array $availableTimeslots,
        DateTime $lastUpdated,
        ?int $timeslotIncrement
    )
    {
        $this->id = $id;
        $this->beginFrom = $beginFrom;
        $this->endBefore = $endBefore;
        $this->availableTimeslots = $availableTimeslots;
        $this->lastUpdated = $lastUpdated;
        $this->timeslotIncrement = $timeslotIncrement;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBeginFrom(): DateTime
    {
        return $this->beginFrom;
    }

    public function getEndBefore(): DateTime
    {
        return $this->endBefore;
    }

    public function getTimeslotIncrement(): ?int
    {
        return $this->timeslotIncrement;
    }

    /**
     * @return Timeslot[]
     */
    public function getAvailableTimeslots(): array
    {
        return $this->availableTimeslots;
    }

    public function getLastUpdated(): DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'id' => $this->id,
            'begin_from' => DateTimeFormatter::format($this->beginFrom),
            'end_before' => DateTimeFormatter::format($this->endBefore),
            'available_timeslots' => $this->availableTimeslots,
            'last_updated' => DateTimeFormatter::format($this->lastUpdated),
        ];

        if ($this->timeslotIncrement !== null) {
            $return['timeslot_increment'] = $this->timeslotIncrement;
        }

        return $return;
    }
}
