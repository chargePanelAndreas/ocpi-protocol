<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use Chargemap\OCPI\Common\Utils\DateTimeFormatter;
use Chargemap\OCPI\Common\Utils\PartialModel;
use DateTime;
use JsonSerializable;

/**
 * @method bool hasBeginFrom()
 * @method self withBeginFrom(?DateTime $beginFrom)
 * @method bool hasEndBefore()
 * @method self withEndBefore(?DateTime $endBefore)
 * @method bool hasTimeslotIncrement()
 * @method self withTimeslotIncrement(?int $timeslotIncrement)
 * @method bool hasAvailableTimeslots()
 * @method self withAvailableTimeslots(?array $availableTimeslots)
 * @method bool hasLastUpdated()
 * @method self withLastUpdated(?DateTime $lastUpdated)
 */
class PartialCalendar extends PartialModel implements JsonSerializable
{
    private ?DateTime $beginFrom = null;
    private ?DateTime $endBefore = null;
    private ?int $timeslotIncrement = null;
    /** @var Timeslot[] */
    private ?array $availableTimeslots = null;
    private ?DateTime $lastUpdated = null;

    protected function _withBeginFrom(?DateTime $beginFrom): self
    {
        $this->beginFrom = $beginFrom;
        return $this;
    }

    protected function _withEndBefore(?DateTime $endBefore): self
    {
        $this->endBefore = $endBefore;
        return $this;
    }

    protected function _withTimeslotIncrement(?int $timeslotIncrement): self
    {
        $this->timeslotIncrement = $timeslotIncrement;
        return $this;
    }

    protected function _withAvailableTimeslots(?array $availableTimeslots): self
    {
        $this->availableTimeslots = $availableTimeslots;
        return $this;
    }

    protected function _withLastUpdated(?DateTime $lastUpdated): self
    {
        $this->lastUpdated = $lastUpdated;
        return $this;
    }

    public function getBeginFrom(): ?DateTime
    {
        return $this->beginFrom;
    }

    public function getEndBefore(): ?DateTime
    {
        return $this->endBefore;
    }

    public function getTimeslotIncrement(): ?int
    {
        return $this->timeslotIncrement;
    }

    public function getAvailableTimeslots(): ?array
    {
        return $this->availableTimeslots;
    }

    public function getLastUpdated(): ?DateTime
    {
        return $this->lastUpdated;
    }

    public function jsonSerialize(): array
    {
        $return = [];

        if ($this->hasBeginFrom()) {
            $return['begin_from'] = $this->beginFrom === null ? null : DateTimeFormatter::format($this->beginFrom);
        }
        if ($this->hasEndBefore()) {
            $return['end_before'] = $this->endBefore === null ? null : DateTimeFormatter::format($this->endBefore);
        }
        if ($this->hasTimeslotIncrement()) {
            $return['timeslot_increment'] = $this->timeslotIncrement;
        }
        if ($this->hasAvailableTimeslots()) {
            $return['available_timeslots'] = $this->availableTimeslots ?? [];
        }
        if ($this->hasLastUpdated()) {
            $return['last_updated'] = $this->lastUpdated === null ? null : DateTimeFormatter::format($this->lastUpdated);
        }

        return $return;
    }
}
