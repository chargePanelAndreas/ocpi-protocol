<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_2_1\Common\Models;

use InvalidArgumentException;
use JsonSerializable;

class Hours implements JsonSerializable
{
    /** @var RegularHours[] */
    private array $regularHours = [];

    private bool $twentyFourSeven;

    /** @var ExceptionalPeriod[] */
    private array $exceptionalOpenings = [];

    /** @var ExceptionalPeriod[] */
    private array $exceptionalClosings = [];

    public function __construct(bool $twentyFourSeven)
    {
        $this->twentyFourSeven = $twentyFourSeven;
    }

    public function addHours(RegularHours $hours): self
    {
        if ($this->twentyFourSeven) {
            throw new InvalidArgumentException('You can not add a RegularHours when twentyfourseven is set to true');
        }

        $this->regularHours[] = $hours;

        return $this;
    }

    public function addExceptionalOpening(ExceptionalPeriod $exceptionalPeriod): self
    {
        $this->exceptionalOpenings[] = $exceptionalPeriod;
        return $this;
    }

    public function addExceptionalClosing(ExceptionalPeriod $exceptionalPeriod): self
    {
        $this->exceptionalClosings[] = $exceptionalPeriod;
        return $this;
    }

    /**
     * @return RegularHours[]
     */
    public function getRegularHours(): array
    {
        return $this->regularHours;
    }

    public function isTwentyFourSeven(): bool
    {
        return $this->twentyFourSeven;
    }

    /**
     * @return ExceptionalPeriod[]
     */
    public function getExceptionalOpenings(): array
    {
        return $this->exceptionalOpenings;
    }

    /**
     * @return ExceptionalPeriod[]
     */
    public function getExceptionalClosings(): array
    {
        return $this->exceptionalClosings;
    }

    public function jsonSerialize(): array
    {
        $return = [
        ];

        if (count($this->exceptionalOpenings) > 0) {
            $return['exceptional_openings'] = $this->exceptionalOpenings;
        }

        if (count($this->exceptionalClosings) > 0) {
            $return['exceptional_closings'] = $this->exceptionalClosings;
        }

        if ($this->twentyFourSeven) {
            $return['twentyfourseven'] = $this->twentyFourSeven;
        } else {
			$return['regular_hours'] = array_map(
				function($h) {return (object) $h->jsonSerialize();}, 
				$this->regularHours);
        }

        return $return;
    }
}
